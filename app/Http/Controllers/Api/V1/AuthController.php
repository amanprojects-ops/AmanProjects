<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Issue Sanctum Bearer token for the LeadHarvest Chrome Extension
     */
    public function token(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email'       => 'required|email',
            'password'    => 'required|string',
            'device_name' => 'nullable|string|max:100',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'status'     => 'error',
                'error_code' => 'INVALID_CREDENTIALS',
                'message'    => 'The provided credentials do not match our records.',
            ], 401);
        }

        // Generate Sanctum token with scoped abilities for extension
        $deviceName = $validated['device_name'] ?? 'LeadHarvest_Extension';
        $token = $user->createToken($deviceName, [
            'leads:sync',
            'leads:validate',
            'leads:read',
        ]);

        return response()->json([
            'status' => 'success',
            'data'   => [
                'token'      => $token->plainTextToken,
                'token_type' => 'Bearer',
                'expires_at' => now()->addYear()->toIso8601String(),
                'user'       => [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                    'roles' => $user->roles()->pluck('name'),
                ],
            ],
        ]);
    }

    /**
     * Return currently authenticated user profile
     */
    public function me(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'status' => 'success',
            'data'   => [
                'user_id'     => $user->id,
                'name'        => $user->name,
                'email'       => $user->email,
                'roles'       => $user->roles()->pluck('name'),
                'permissions' => $user->hasRole('super-admin') ? ['all'] : ['manage_leads'],
            ],
        ]);
    }

    /**
     * Revoke current token
     */
    public function revoke(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Token successfully revoked.',
        ]);
    }
}
