<?php

namespace Tests\Unit;

use App\Models\Lead;
use App\Services\OpportunityAnalysisEngine;
use Tests\TestCase;

class OpportunityAnalysisTest extends TestCase
{
    public function test_opportunity_engine_calculates_high_need_for_lead_without_website(): void
    {
        $lead = new Lead([
            'business_name' => 'Offline Tailor Shop',
            'category'      => 'Tailor & Alterations',
            'website'       => null,
            'primary_phone' => '+919876543210',
            'rating'        => 3.5,
            'review_count'  => 4,
        ]);
        $lead->id = 999;

        $engine = new OpportunityAnalysisEngine();
        $analysis = $engine->analyze($lead);

        // Web Score must be 100 because there is no website
        $this->assertEquals(100, $analysis->web_score);

        // Overall Score must be high due to web + SEO deficit
        $this->assertGreaterThanOrEqual(50, $analysis->overall_score);

        // Must contain NO_WEBSITE gap code
        $gapCodes = array_column($analysis->identified_gaps, 'code');
        $this->assertContains('NO_WEBSITE', $gapCodes);
    }
}
