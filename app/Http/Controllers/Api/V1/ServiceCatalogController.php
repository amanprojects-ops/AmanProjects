<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Service;
use Illuminate\Http\JsonResponse;

class ServiceCatalogController extends Controller
{
    /**
     * Retrieve active services with pricing plans for extension reference
     */
    public function index(): JsonResponse
    {
        $services = Service::active()
            ->select(['id', 'title', 'slug', 'desc', 'features', 'pricing_tiers', 'is_active', 'sort_order'])
            ->get();

        $plans = Plan::select(['id', 'name', 'price', 'period', 'desc', 'features', 'featured'])
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => [
                'services' => $services,
                'plans'    => $plans,
            ],
        ]);
    }
}
