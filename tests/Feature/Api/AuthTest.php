<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_can_authenticate_and_receive_sanctum_token(): void
    {
        $user = User::factory()->create([
            'email'    => 'tester@amanprojects.com',
            'password' => bcrypt('SecretPass123!'),
        ]);

        $response = $this->postJson('/api/v1/auth/token', [
            'email'       => 'tester@amanprojects.com',
            'password'    => 'SecretPass123!',
            'device_name' => 'LeadHarvest_Test',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'token',
                    'token_type',
                    'user' => ['id', 'name', 'email'],
                ],
            ]);
    }

    public function test_rejects_invalid_credentials(): void
    {
        $response = $this->postJson('/api/v1/auth/token', [
            'email'    => 'nobody@amanprojects.com',
            'password' => 'WrongPassword',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'status'     => 'error',
                'error_code' => 'INVALID_CREDENTIALS',
            ]);
    }

    public function test_can_verify_token_via_auth_me(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('Test_Token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson('/api/v1/auth/me');

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data'   => [
                    'user_id' => $user->id,
                    'email'   => $user->email,
                ],
            ]);
    }
}
