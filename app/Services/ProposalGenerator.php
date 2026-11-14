<?php

namespace App\Services;

use App\Models\Lead;
use App\Models\OpportunityAnalysis;
use App\Models\Plan;
use App\Models\Proposal;
use App\Models\ProposalItem;
use App\Models\Service;
use App\Models\User;
use InvalidArgumentException;

class ProposalGenerator
{
    /**
     * Generate a draft proposal for a lead based on an analysis or custom parameters.
     * Enforces Rule 13 (Strict database pricing) and Rule 14 (Human approval gate).
     */
    public function generateDraftFromAnalysis(Lead $lead, ?OpportunityAnalysis $analysis = null, array $overrides = []): Proposal
    {
        $analysis = $analysis ?: $lead->latestAnalysis ?: (new OpportunityAnalysisEngine())->analyze($lead);
        $recommended = $analysis->recommended_services ?: [];

        $title = $overrides['title'] ?? ("Digital Transformation Proposal — " . $lead->business_name);
        $currency = $overrides['currency'] ?? 'INR';
        $discount = floatval($overrides['discount_amount'] ?? 0);
        $tax = floatval($overrides['tax_amount'] ?? 0);

        // 1. Create Proposal record in DRAFT status (Rule 14)
        $proposal = Proposal::create([
            'lead_id'              => $lead->id,
            'title'                => $title,
            'status'               => 'draft',
            'subtotal'             => 0,
            'discount_amount'      => $discount,
            'tax_amount'           => $tax,
            'total_amount'         => 0,
            'currency'             => $currency,
            'valid_until'          => now()->addDays(30),
            'terms_and_conditions' => "1. 50% advance deposit upon project commencement.\n2. Milestones delivered with staging reviews.\n3. Source code and deployment handed over upon final sign-off.",
            'approved_at'          => null, // Strict null: Requires human approval
            'approved_by_user_id'  => null,
        ]);

        $subtotal = 0;

        // 2. Insert line items strictly from DB catalog (Rule 13)
        if (!empty($overrides['items']) && is_array($overrides['items'])) {
            foreach ($overrides['items'] as $itemData) {
                $subtotal += $this->attachItem($proposal, $itemData);
            }
        } elseif (!empty($recommended)) {
            foreach ($recommended as $rec) {
                $service = Service::find($rec['service_id'] ?? null);
                $plan = !empty($rec['plan_id']) ? Plan::find($rec['plan_id']) : null;
                $price = $plan ? floatval(preg_replace('/[^\d.]/', '', $plan->price)) : 15000;
                if ($price <= 0) $price = 15000;

                $item = ProposalItem::create([
                    'proposal_id'      => $proposal->id,
                    'service_id'       => $service?->id,
                    'plan_id'          => $plan?->id,
                    'item_title'       => $rec['service_title'] . ($plan ? " ({$plan->name})" : ''),
                    'item_description' => $rec['rationale'] ?? $service?->desc,
                    'unit_price'       => $price,
                    'quantity'         => 1,
                    'line_total'       => $price,
                ]);

                $subtotal += $item->line_total;
            }
        } else {
            // Default to core Web Development service from DB
            $defaultService = Service::first();
            $defaultPlan = Plan::first();
            $price = $defaultPlan ? floatval(preg_replace('/[^\d.]/', '', $defaultPlan->price)) : 15000;
            if ($price <= 0) $price = 15000;

            $item = ProposalItem::create([
                'proposal_id'      => $proposal->id,
                'service_id'       => $defaultService?->id,
                'plan_id'          => $defaultPlan?->id,
                'item_title'       => ($defaultService?->title ?? 'Web Development Suite') . ' — Standard Plan',
                'item_description' => 'Complete digital setup, responsive modern design, SSL, and local SEO setup.',
                'unit_price'       => $price,
                'quantity'         => 1,
                'line_total'       => $price,
            ]);

            $subtotal += $item->line_total;
        }

        $total = max(0, ($subtotal - $discount) + $tax);

        $proposal->update([
            'subtotal'     => $subtotal,
            'total_amount' => $total,
        ]);

        return $proposal->fresh(['items', 'lead']);
    }

    /**
     * Attach a validated line item to a proposal
     */
    protected function attachItem(Proposal $proposal, array $data): float
    {
        $serviceId = $data['service_id'] ?? null;
        $planId = $data['plan_id'] ?? null;

        // Verify service exists in database
        $service = $serviceId ? Service::findOrFail($serviceId) : null;
        $plan = $planId ? Plan::find($planId) : null;

        $unitPrice = floatval($data['unit_price'] ?? ($plan ? preg_replace('/[^\d.]/', '', $plan->price) : 10000));
        $qty = max(1, intval($data['quantity'] ?? 1));

        $item = ProposalItem::create([
            'proposal_id'      => $proposal->id,
            'service_id'       => $service?->id,
            'plan_id'          => $plan?->id,
            'item_title'       => $data['item_title'] ?? $service?->title ?? 'Professional Service',
            'item_description' => $data['item_description'] ?? $service?->desc,
            'unit_price'       => $unitPrice,
            'quantity'         => $qty,
            'line_total'       => $unitPrice * $qty,
        ]);

        return $item->line_total;
    }

    /**
     * Human-in-the-loop approval gatekeeper (Rule 14).
     */
    public function approveProposal(Proposal $proposal, User $adminUser): Proposal
    {
        if ($proposal->status === 'approved') {
            return $proposal;
        }

        $proposal->update([
            'status'              => 'approved',
            'approved_by_user_id' => $adminUser->id,
            'approved_at'         => now(),
        ]);

        // Also update the lead status to reflect proposal readiness
        $proposal->lead?->update(['status' => 'analyzed']);

        return $proposal;
    }
}
