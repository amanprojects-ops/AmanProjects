<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Plan;
use App\Models\Proposal;
use App\Models\Service;
use App\Services\OpportunityAnalysisEngine;
use App\Services\ProposalGenerator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeadAdminController extends Controller
{
    public function __construct(
        protected OpportunityAnalysisEngine $analysisEngine,
        protected ProposalGenerator $proposalGenerator
    ) {}

    /**
     * Display listing of leads
     */
    public function index(Request $request): View
    {
        $query = Lead::with(['latestAnalysis', 'proposals', 'contacts'])
            ->active();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('business_name', 'like', "%{$term}%")
                  ->orWhere('primary_phone', 'like', "%{$term}%")
                  ->orWhere('primary_email', 'like', "%{$term}%")
                  ->orWhere('category', 'like', "%{$term}%");
            });
        }

        $leads = $query->latest('id')->paginate(15)->withQueryString();

        $stats = [
            'total'     => Lead::active()->count(),
            'new'       => Lead::active()->where('status', 'new')->count(),
            'analyzed'  => Lead::active()->where('status', 'analyzed')->count(),
            'proposals' => Proposal::count(),
        ];

        return view('admin.leads.index', compact('leads', 'stats'));
    }

    /**
     * Display lead detail dossier
     */
    public function show(int $id): View
    {
        $lead = Lead::with([
            'contacts',
            'socialProfiles',
            'opportunityAnalyses',
            'proposals.items.service',
            'proposals.items.plan',
            'integrationLogs',
        ])->findOrFail($id);

        $services = Service::active()->get();
        $plans = Plan::all();

        return view('admin.leads.show', compact('lead', 'services', 'plans'));
    }

    /**
     * Trigger opportunity gap analysis
     */
    public function analyze(int $id): RedirectResponse
    {
        $lead = Lead::findOrFail($id);
        $analysis = $this->analysisEngine->analyze($lead);

        if ($lead->status === 'new') {
            $lead->update(['status' => 'analyzed']);
        }

        return redirect()->route('admin.leads.show', $id)
            ->with('success', "Opportunity Audit completed! Score: {$analysis->overall_score}/100");
    }

    /**
     * Generate or customize proposal draft
     */
    public function storeProposal(Request $request, int $id): RedirectResponse
    {
        $lead = Lead::findOrFail($id);

        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'currency'        => 'required|string|size:3',
            'discount_amount' => 'nullable|numeric|min:0',
            'tax_amount'      => 'nullable|numeric|min:0',
            'service_id'      => 'required|exists:services,id',
            'plan_id'         => 'nullable|exists:plans,id',
            'unit_price'      => 'required|numeric|min:0',
            'terms'           => 'nullable|string',
        ]);

        $overrides = [
            'title'                => $validated['title'],
            'currency'             => $validated['currency'],
            'discount_amount'      => $validated['discount_amount'] ?? 0,
            'tax_amount'           => $validated['tax_amount'] ?? 0,
            'terms_and_conditions' => $validated['terms'] ?? null,
            'items'                => [
                [
                    'service_id' => $validated['service_id'],
                    'plan_id'    => $validated['plan_id'] ?? null,
                    'item_title' => $validated['title'],
                    'unit_price' => $validated['unit_price'],
                    'quantity'   => 1,
                ]
            ],
        ];

        $proposal = $this->proposalGenerator->generateDraftFromAnalysis($lead, null, $overrides);

        return redirect()->route('admin.leads.show', $id)
            ->with('success', "Proposal #{$proposal->proposal_number} drafted successfully! Human approval required before dispatch.");
    }

    /**
     * Approve proposal (Rule 14 Gatekeeper)
     */
    public function approveProposal(Request $request, int $id, int $proposalId): RedirectResponse
    {
        $proposal = Proposal::where('lead_id', $id)->findOrFail($proposalId);
        $this->proposalGenerator->approveProposal($proposal, $request->user());

        return redirect()->route('admin.leads.show', $id)
            ->with('success', "Proposal #{$proposal->proposal_number} approved! Dispatch link unlocked.");
    }

    /**
     * Soft delete lead
     */
    public function destroy(int $id): RedirectResponse
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        return redirect()->route('admin.leads.index')
            ->with('success', "Lead #{$id} archived successfully.");
    }
}
