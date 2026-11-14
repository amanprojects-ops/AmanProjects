<?php

namespace Tests\Feature\Api;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class LeadSyncTest extends TestCase
{
    public function test_can_sync_lead_idempotently(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('LeadHarvest_Test')->plainTextToken;
        $idempotencyKey = (string) Str::uuid();

        $payload = [
            'batch_metadata' => [
                'client_name'    => 'LeadHarvest',
                'client_version' => '1.9.1',
                'keyword'        => 'web agency mumbai',
            ],
            'leads' => [
                [
                    'business_name'   => 'Acme Digital Labs',
                    'category'        => 'Marketing Agency',
                    'website'         => 'https://acmedigital.com',
                    'primary_phone'   => '+919876543210',
                    'primary_email'   => 'hello@acmedigital.com',
                    'google_place_id' => 'ChIJ_test_place_id_123',
                    'rating'          => 4.8,
                    'review_count'    => 45,
                    'contacts'        => [
                        ['type' => 'email', 'value' => 'hello@acmedigital.com', 'is_primary' => true],
                        ['type' => 'phone', 'value' => '+919876543210', 'is_primary' => true],
                    ],
                ]
            ]
        ];

        // First attempt: Must insert
        $firstResponse = $this->withHeaders([
            'Authorization'     => 'Bearer ' . $token,
            'X-Idempotency-Key' => $idempotencyKey,
        ])->postJson('/api/v1/leads/sync', $payload);

        $firstResponse->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data'   => [
                    'summary' => [
                        'total'    => 1,
                        'inserted' => 1,
                        'updated'  => 0,
                    ]
                ]
            ]);

        // Second attempt with identical X-Idempotency-Key: Must return cached replay, no duplicate
        $secondResponse = $this->withHeaders([
            'Authorization'     => 'Bearer ' . $token,
            'X-Idempotency-Key' => $idempotencyKey,
        ])->postJson('/api/v1/leads/sync', $payload);

        $secondResponse->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data'   => [
                    'summary' => [
                        'total'    => 1,
                        'inserted' => 1,
                    ]
                ]
            ]);

        // Assert database has only 1 lead, not 2
        $this->assertDatabaseHas('leads', [
            'google_place_id' => 'ChIJ_test_place_id_123',
            'business_name'   => 'Acme Digital Labs',
        ]);
    }

    public function test_can_validate_contacts(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('LeadHarvest_Test')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/v1/leads/validate-contact', [
                'items' => [
                    ['type' => 'email', 'value' => 'valid.contact@gmail.com'],
                    ['type' => 'phone', 'value' => '9876543210'],
                ]
            ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'results' => [
                        '*' => ['type', 'value', 'overall_valid']
                    ]
                ]
            ]);
    }
}
