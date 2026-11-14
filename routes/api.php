<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\LeadController;
use App\Http\Controllers\Api\V1\ServiceCatalogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes — Version 1
|--------------------------------------------------------------------------
|
| All API endpoints are versioned with the prefix /api/v1/
| Authenticated routes utilize Laravel Sanctum Bearer tokens.
|
*/

Route::prefix('v1')->group(function () {

    // Public Authentication Endpoint (throttled)
    Route::post('/auth/token', [AuthController::class, 'token'])
        ->middleware('throttle:5,1');

    // Protected API Endpoints (Sanctum Authenticated)
    Route::middleware('auth:sanctum')->group(function () {

        // Session & Operator Profile
        Route::get('/auth/me', [AuthController::class, 'me']);
        Route::post('/auth/revoke', [AuthController::class, 'revoke']);

        // Service Catalog Reference
        Route::get('/services', [ServiceCatalogController::class, 'index']);

        // Lead Synchronization & Management
        Route::prefix('leads')->group(function () {
            Route::post('/sync', [LeadController::class, 'sync'])
                ->middleware('throttle:60,1');

            Route::get('/', [LeadController::class, 'index']);
            Route::get('/{id}', [LeadController::class, 'show']);

            Route::post('/validate-contact', [LeadController::class, 'validateContact'])
                ->middleware('throttle:60,1');

            Route::post('/{id}/analyze', [LeadController::class, 'analyze']);
            Route::post('/{id}/proposals', [LeadController::class, 'createProposal']);
            Route::post('/{id}/opt-out', [LeadController::class, 'optOut']);
        });

    });

});
