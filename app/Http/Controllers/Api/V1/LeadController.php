<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\SyncLeadRequest;
use App\Models\IntegrationLog;
use App\Models\Lead;
use App\Models\LeadContact;
use App\Models\LeadOptOut;
use App\Models\LeadSocialProfile;
use App\Models\SyncBatch;
use App\Services\LeadValidationService;
use App\Services\OpportunityAnalysisEngine;
use App\Services\ProposalGenerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LeadController extends Controller
{
    public function __construct(
        protected LeadValidationService $validator,
        protected OpportunityAnalysisEngine $analysisEngine,
        protected ProposalGenerator $proposalGenerator
    ) {}

    /**
     * Idempotent Lead Sync Endpoint (Rule 5, 6, 7)
     */
    public function sync(SyncLeadRequest $request): JsonResponse
    {
        $idempotencyKey = $request->header('X-Idempotency-Key') ?: Str::uuid()->toString();
        $payload = $request->all();
        $payloadHash = hash('sha256', json_encode($payload));
        $user = $request->user();

        // 1. Check existing batch by Idempotency Key (Rule 6)
        $existingBatch = SyncBatch::where('idempotency_key', $idempotencyKey)->first();
        if ($existingBatch) {
            if ($existingBatch->payload_hash === $payloadHash && !empty($existingBatch->response_cache)) {
                return response()->json($existingBatch->response_cache);
            }
        }

        // 2. Initialize Sync Batch
        $meta = $payload['batch_metadata'] ?? [];
        $batch = SyncBatch::create([
            'user_id'         => $user?->id,
            'idempotency_key' => $idempotencyKey,
            'payload_hash'    => $payloadHash,
            'client_name'     => $meta['client_name'] ?? 'LeadHarvest',
            'client_version'  => $meta['client_version'] ?? '1.9.1',
            'total_records'   => count($payload['leads']),
            'status'          => 'processing',
        ]);

        $inserted = 0;
        $updated = 0;
        $skipped = 0;
        $failed = 0;
        $results = [];

        DB::beginTransaction();
        try {
            foreach ($payload['leads'] as $item) {
                $businessName = trim($item['business_name']);
                $website = trim($item['website'] ?? '');
                $phone = trim($item['primary_phone'] ?? '');
                $email = trim($item['primary_email'] ?? '');
                $placeId = !empty($item['google_place_id']) ? trim($item['google_place_id']) : null;

                $domain = '';
                if (!empty($website)) {
                    $parsed = parse_url($website, PHP_URL_HOST);
                    $domain = strtolower(preg_replace('/^www\./i', '', $parsed ?: $website));
                }

                // Check opt-out blacklist (Rule 15)
                if (LeadOptOut::isBlacklisted($email, $domain, $phone)) {
                    $skipped++;
                    $results[] = [
                        'business_name' => $businessName,
                        'action'        => 'skipped_opted_out',
                        'message'       => 'Prospect is registered in privacy opt-out registry.',
                    ];
                    continue;
                }

                // Deduplication query: Check by place_id OR (normalized_domain + phone)
                $existingLead = null;
                if (!empty($placeId)) {
                    $existingLead = Lead::where('google_place_id', $placeId)->first();
                }
                if (!$existingLead && !empty($domain) && !empty($phone)) {
                    $cleanPhone = preg_replace('/[^\d+]/', '', $phone);
                    $existingLead = Lead::where('normalized_domain', $domain)
                        ->where('primary_phone', 'like', "%{$cleanPhone}%")
                        ->first();
                }

                if ($existingLead) {
                    // Update metadata if newer info provided
                    $existingLead->update([
                        'rating'       => $item['rating'] ?? $existingLead->rating,
                        'review_count' => $item['review_count'] ?? $existingLead->review_count,
                        'address'      => $item['address'] ?? $existingLead->address,
                    ]);
                    $updated++;
                    $results[] = [
                        'lead_id'       => $existingLead->id,
                        'business_name' => $existingLead->business_name,
                        'action'        => 'updated',
                    ];
                    continue;
                }

                // Create New Lead
                $lead = Lead::create([
                    'business_name'     => $businessName,
                    'category'          => $item['category'] ?? null,
                    'website'           => $website ?: null,
                    'normalized_domain' => $domain ?: null,
                    'primary_phone'     => $phone ?: null,
                    'primary_email'     => $email ?: null,
                    'address'           => $item['address'] ?? null,
                    'latitude'          => $item['latitude'] ?? null,
                    'longitude'         => $item['longitude'] ?? null,
                    'google_place_id'   => $placeId,
                    'google_cid'        => $item['google_cid'] ?? null,
                    'rating'            => $item['rating'] ?? 0.00,
                    'review_count'      => $item['review_count'] ?? 0,
                    'provenance_source' => $item['provenance_source'] ?? 'extension_assisted',
                    'provenance_url'    => $item['provenance_url'] ?? null,
                    'captured_at'       => $meta['captured_at'] ?? now(),
                    'assigned_user_id'  => $user?->id,
                ]);

                // Store Contacts
                if (!empty($item['contacts']) && is_array($item['contacts'])) {
                    foreach ($item['contacts'] as $c) {
                        $cType = $c['type'];
                        $cVal = trim($c['value']);
                        $normVal = $cType === 'email' ? strtolower($cVal) : preg_replace('/[^\d+]/', '', $cVal);

                        // Validate offline
                        $valRes = ($cType === 'email')
                            ? $this->validator->validateEmail($cVal, false)
                            : $this->validator->validatePhone($cVal);

                        LeadContact::firstOrCreate([
                            'lead_id'          => $lead->id,
                            'type'             => $cType,
                            'normalized_value' => $normVal,
                        ], [
                            'value'              => $cVal,
                            'is_primary'         => !empty($c['is_primary']),
                            'is_offline_valid'   => $valRes['overall_valid'] ?? false,
                            'validation_details' => $valRes,
                        ]);
                    }
                }

                // Store Social Profiles
                if (!empty($item['social_profiles']) && is_array($item['social_profiles'])) {
                    foreach ($item['social_profiles'] as $sp) {
                        LeadSocialProfile::firstOrCreate([
                            'lead_id'  => $lead->id,
                            'platform' => $sp['platform'],
                        ], [
                            'profile_url' => $sp['profile_url'],
                        ]);
                    }
                }

                $inserted++;
                $results[] = [
                    'lead_id'       => $lead->id,
                    'business_name' => $lead->business_name,
                    'action'        => 'inserted',
                    'status'        => 'new',
                ];
            }

            $batch->update([
                'status'           => 'completed',
                'inserted_records' => $inserted,
                'updated_records'  => $updated,
                'skipped_records'  => $skipped,
                'failed_records'   => $failed,
            ]);

            DB::commit();

            // Log integration success (Rule 7)
            IntegrationLog::create([
                'sync_batch_id' => $batch->id,
                'event'         => 'batch_sync_completed',
                'level'         => 'info',
                'message'       => "Batch synced {$inserted} inserted, {$updated} updated, {$skipped} skipped.",
            ]);

            $responsePayload = [
                'status' => 'success',
                'data'   => [
                    'sync_batch_id'   => $batch->id,
                    'idempotency_key' => $idempotencyKey,
                    'summary'         => [
                        'total'     => count($payload['leads']),
                        'inserted'  => $inserted,
                        'updated'   => $updated,
                        'skipped'   => $skipped,
                        'failed'    => $failed,
                    ],
                    'results'         => $results,
                ],
            ];

            // Cache response for idempotent replays
            $batch->update(['response_cache' => $responsePayload]);

            return response()->json($responsePayload);
        } catch (\Throwable $e) {
            DB::rollBack();

            $batch->update(['status' => 'failed']);

            IntegrationLog::create([
                'sync_batch_id' => $batch->id,
                'event'         => 'batch_sync_failed',
                'level'         => 'error',
                'message'       => $e->getMessage(),
                'error_code'    => 'SYNC_TRANSACTION_FAILED',
            ]);

            return response()->json([
                'status'     => 'error',
                'error_code' => 'SYNC_FAILED',
                'message'    => 'An error occurred while processing lead synchronization: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * List leads with filtering, searching, and pagination
     */
    public function index(Request $request): JsonResponse
    {
        $query = Lead::with(['latestAnalysis', 'proposals', 'contacts'])
            ->active();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category', 'like', "%{$request->category}%");
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('business_name', 'like', "%{$term}%")
                  ->orWhere('primary_phone', 'like', "%{$term}%")
                  ->orWhere('primary_email', 'like', "%{$term}%")
                  ->orWhere('website', 'like', "%{$term}%");
            });
        }

        $perPage = min(100, max(5, intval($request->get('per_page', 15))));
        $leads = $query->latest('id')->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data'   => $leads,
        ]);
    }

    /**
     * Retrieve single lead dossier
     */
    public function show(int $id): JsonResponse
    {
        $lead = Lead::with([
            'contacts',
            'socialProfiles',
            'opportunityAnalyses',
            'proposals.items',
            'integrationLogs',
        ])->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data'   => $lead,
        ]);
    }

    /**
     * Validate phone / email batch
     */
    public function validateContact(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'items'         => 'required|array|min:1|max:50',
            'items.*.type'  => 'required|string|in:email,phone,mobile,whatsapp',
            'items.*.value' => 'required|string|max:255',
        ]);

        $results = $this->validator->validateBatch($validated['items']);

        return response()->json([
            'status' => 'success',
            'data'   => [
                'results' => $results,
            ],
        ]);
    }

    /**
     * Run digital opportunity analysis for a lead
     */
    public function analyze(int $id): JsonResponse
    {
        $lead = Lead::findOrFail($id);
        $analysis = $this->analysisEngine->analyze($lead);

        // Update lead status to analyzed
        if ($lead->status === 'new') {
            $lead->update(['status' => 'analyzed']);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $analysis,
        ]);
    }

    /**
     * Generate draft proposal for an analyzed lead
     */
    public function createProposal(Request $request, int $id): JsonResponse
    {
        $lead = Lead::findOrFail($id);

        $overrides = $request->validate([
            'title'           => 'nullable|string|max:255',
            'currency'        => 'nullable|string|size:3',
            'discount_amount' => 'nullable|numeric|min:0',
            'tax_amount'      => 'nullable|numeric|min:0',
            'items'           => 'nullable|array',
            'items.*.service_id' => 'required_with:items|exists:services,id',
            'items.*.plan_id'    => 'nullable|exists:plans,id',
            'items.*.item_title' => 'required_with:items|string|max:255',
            'items.*.unit_price' => 'required_with:items|numeric|min:0',
            'items.*.quantity'   => 'nullable|integer|min:1',
        ]);

        $proposal = $this->proposalGenerator->generateDraftFromAnalysis($lead, null, $overrides);

        return response()->json([
            'status' => 'success',
            'data'   => $proposal,
        ], 201);
    }

    /**
     * Opt out prospect and scrub identifiable details (Rule 15)
     */
    public function optOut(Request $request, int $id): JsonResponse
    {
        $lead = Lead::findOrFail($id);
        $reason = $request->input('reason', 'Operator opt-out request');

        // 1. Create blacklist records
        LeadOptOut::create([
            'email_hash'      => !empty($lead->primary_email) ? hash('sha256', strtolower($lead->primary_email)) : null,
            'domain_hash'     => !empty($lead->normalized_domain) ? hash('sha256', $lead->normalized_domain) : null,
            'phone_hash'      => !empty($lead->primary_phone) ? hash('sha256', preg_replace('/[^\d+]/', '', $lead->primary_phone)) : null,
            'reason'          => $reason,
            'requested_by_ip' => $request->ip(),
            'opted_out_at'    => now(),
        ]);

        // 2. Scrub identifiable personal data
        $lead->update([
            'business_name' => '[Opted Out Lead #' . $lead->id . ']',
            'primary_phone' => null,
            'primary_email' => null,
            'address'       => null,
            'is_opted_out'  => true,
            'status'        => 'disqualified',
        ]);

        // 3. Delete sub-contacts
        $lead->contacts()->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Lead successfully opted out and personally identifiable records scrubbed.',
            'data'    => [
                'lead_id'      => $lead->id,
                'is_opted_out' => true,
            ],
        ]);
    }
}
