<?php

namespace App\Services;

use App\Models\Lead;
use App\Models\OpportunityAnalysis;
use App\Models\Plan;
use App\Models\Service;

class OpportunityAnalysisEngine
{
    /**
     * Run digital audit and calculate opportunity scores for a lead
     */
    public function analyze(Lead $lead): OpportunityAnalysis
    {
        $identifiedGaps = [];

        // 1. Web Need Score (35% weight)
        $webScore = 0;
        if (empty($lead->website)) {
            $webScore = 100;
            $identifiedGaps[] = [
                'code'        => 'NO_WEBSITE',
                'category'    => 'web',
                'severity'    => 'critical',
                'title'       => 'Missing Business Website',
                'description' => 'The business has no discoverable website, severely limiting organic discoverability and digital conversions.',
            ];
        } else {
            if (!str_starts_with(strtolower($lead->website), 'https://')) {
                $webScore += 30;
                $identifiedGaps[] = [
                    'code'        => 'NO_SSL',
                    'category'    => 'web',
                    'severity'    => 'high',
                    'title'       => 'Insecure HTTP Protocol',
                    'description' => 'Website does not force HTTPS, displaying security warnings in modern browsers.',
                ];
            }
        }
        $webScore = min(100, $webScore);

        // 2. App Need Score (25% weight)
        $appScore = 0;
        $category = strtolower($lead->category ?? '');
        $appFriendlyCategories = [
            'restaurant' => 45, 'food' => 45, 'cafe' => 40,
            'bakery' => 35, 'grocery' => 40, 'retail' => 35,
            'salon' => 35, 'spa' => 35, 'clinic' => 35, 'hospital' => 30,
            'fitness' => 35, 'gym' => 35, 'hotel' => 35, 'resort' => 30,
            'logistics' => 30, 'delivery' => 40, 'education' => 30, 'institute' => 30,
        ];

        foreach ($appFriendlyCategories as $key => $weight) {
            if (str_contains($category, $key)) {
                $appScore += $weight;
                break;
            }
        }

        if ($lead->review_count >= 50) {
            $appScore += 25;
        } elseif ($lead->review_count >= 20) {
            $appScore += 15;
        }

        if ($appScore >= 40) {
            $identifiedGaps[] = [
                'code'        => 'HIGH_APP_UTILITY',
                'category'    => 'app',
                'severity'    => 'medium',
                'title'       => 'High Mobile App Potential',
                'description' => 'Business model and customer volume indicate strong return from dedicated customer app (loyalty/ordering/booking).',
            ];
        }
        $appScore = min(100, $appScore);

        // 3. SEO & Reputation Need Score (20% weight)
        $seoScore = 0;
        if ($lead->review_count < 10) {
            $seoScore += 35;
            $identifiedGaps[] = [
                'code'        => 'LOW_REVIEW_VOLUME',
                'category'    => 'seo',
                'severity'    => 'high',
                'title'       => 'Thin Social Proof / Low Reviews',
                'description' => 'Fewer than 10 reviews harms local map pack ranking and customer conversion.',
            ];
        }
        if ($lead->rating > 0 && $lead->rating < 4.0) {
            $seoScore += 30;
            $identifiedGaps[] = [
                'code'        => 'SUB_OPTIMAL_RATING',
                'category'    => 'seo',
                'severity'    => 'medium',
                'title'       => 'Review Rating Under 4.0 Stars',
                'description' => 'Average rating requires reputation management and automated customer review generation.',
            ];
        }
        $seoScore = min(100, $seoScore);

        // 4. Professional Brand Need Score (20% weight)
        $brandScore = 0;
        if (!empty($lead->primary_email)) {
            $email = strtolower($lead->primary_email);
            if (str_ends_with($email, '@gmail.com') || str_ends_with($email, '@yahoo.com') || str_ends_with($email, '@hotmail.com')) {
                $brandScore += 40;
                $identifiedGaps[] = [
                    'code'        => 'GENERIC_EMAIL_DOMAIN',
                    'category'    => 'brand',
                    'severity'    => 'medium',
                    'title'       => 'Generic Free Mailbox in Use',
                    'description' => 'Using @gmail.com or @yahoo.com diminishes enterprise credibility compared to custom domain email.',
                ];
            }
        } else {
            $brandScore += 30;
        }

        $socialCount = $lead->socialProfiles()->count();
        if ($socialCount === 0) {
            $brandScore += 30;
            $identifiedGaps[] = [
                'code'        => 'NO_SOCIAL_CHANNELS',
                'category'    => 'brand',
                'severity'    => 'medium',
                'title'       => 'Absent Social Media Presence',
                'description' => 'No connected Instagram, Facebook, or LinkedIn business profiles found.',
            ];
        }
        $brandScore = min(100, $brandScore);

        // Composite Weighted Score
        $overallScore = round(
            ($webScore * 0.35) +
            ($appScore * 0.25) +
            ($seoScore * 0.20) +
            ($brandScore * 0.20)
        );

        // Dynamic Recommendation Mapping to AmanProjects Database
        $recommendedServices = $this->mapRecommendedServices($webScore, $appScore, $seoScore, $brandScore);

        // Generate Executive Summary
        $summary = $this->buildExecutiveSummary($lead, $overallScore, $webScore, $appScore, $seoScore, $brandScore);

        return OpportunityAnalysis::create([
            'lead_id'              => $lead->id,
            'overall_score'        => $overallScore,
            'web_score'            => $webScore,
            'mobile_score'         => $appScore,
            'seo_score'            => $seoScore,
            'reputation_score'     => $brandScore,
            'identified_gaps'      => $identifiedGaps,
            'recommended_services' => $recommendedServices,
            'executive_summary'    => $summary,
            'analyzer_version'     => '1.0.0',
        ]);
    }

    /**
     * Map identified scores directly to active AmanProjects services & plans records
     */
    protected function mapRecommendedServices(int $webScore, int $appScore, int $seoScore, int $brandScore): array
    {
        $recommendations = [];

        // If Web Need is high, recommend Web Development
        if ($webScore >= 50) {
            $webSvc = Service::where('slug', 'website-developer-in-saharsa')
                ->orWhere('title', 'like', '%web%')
                ->first();

            $plan = Plan::where('featured', true)->first() ?: Plan::first();

            if ($webSvc) {
                $recommendations[] = [
                    'service_id'       => $webSvc->id,
                    'service_title'    => $webSvc->title,
                    'service_slug'     => $webSvc->slug,
                    'plan_id'          => $plan?->id,
                    'plan_name'        => $plan?->name ?? 'Standard',
                    'standard_price'   => $plan?->price ?? 15000,
                    'priority'         => 'high',
                    'rationale'        => 'Modern mobile-responsive web platform with SSL, high performance, and SEO optimization.',
                ];
            }
        }

        // If App Need is high, recommend Mobile App Development
        if ($appScore >= 40) {
            $appSvc = Service::where('slug', 'mobile-app-development')
                ->orWhere('title', 'like', '%app%')
                ->first();

            $plan = Plan::where('name', 'like', '%premium%')->first() ?: Plan::first();

            if ($appSvc) {
                $recommendations[] = [
                    'service_id'       => $appSvc->id,
                    'service_title'    => $appSvc->title,
                    'service_slug'     => $appSvc->slug,
                    'plan_id'          => $plan?->id,
                    'plan_name'        => $plan?->name ?? 'Standard',
                    'standard_price'   => $plan?->price ?? 35000,
                    'priority'         => $appScore >= 60 ? 'high' : 'medium',
                    'rationale'        => 'Custom Android/iOS cross-platform mobile application with push notification and booking engine.',
                ];
            }
        }

        // If SEO Need is high, recommend SEO & Marketing
        if ($seoScore >= 35) {
            $seoSvc = Service::where('slug', 'seo-marketing')
                ->orWhere('title', 'like', '%seo%')
                ->first();

            $plan = Plan::first();

            if ($seoSvc) {
                $recommendations[] = [
                    'service_id'       => $seoSvc->id,
                    'service_title'    => $seoSvc->title,
                    'service_slug'     => $seoSvc->slug,
                    'plan_id'          => $plan?->id,
                    'plan_name'        => $plan?->name ?? 'Growth',
                    'standard_price'   => $plan?->price ?? 10000,
                    'priority'         => 'medium',
                    'rationale'        => 'Local Google Map Pack optimization, schema structured data, and review acquisition campaigns.',
                ];
            }
        }

        return $recommendations;
    }

    protected function buildExecutiveSummary(Lead $lead, int $overall, int $web, int $app, int $seo, int $brand): string
    {
        $priorityText = $overall >= 75 ? 'Critical Digital Need (High-Priority Prospect)' :
            ($overall >= 45 ? 'Moderate Opportunity (Targeted Deficits)' : 'Mature Digital Presence');

        return "Analysis for {$lead->business_name}: Overall Opportunity Score {$overall}/100 [{$priorityText}]. " .
            "Web Need: {$web}/100, Mobile App Fit: {$app}/100, SEO Need: {$seo}/100, Brand & Contact Need: {$brand}/100.";
    }
}
