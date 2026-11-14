<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApiTokenController extends Controller
{
    /**
     * Display list of API tokens for the logged-in admin user
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $tokens = $user->tokens()->latest()->get();
        $apiUrl = url('/api/v1');

        return view('admin.api-tokens.index', compact('user', 'tokens', 'apiUrl'));
    }

    /**
     * Generate a new personal access token for LeadHarvest or developer access
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'token_name' => 'nullable|string|max:100',
        ]);

        $user = $request->user();
        $tokenName = $validated['token_name'] ?: 'LeadHarvest_Chrome_Extension_' . now()->format('Y-m-d');

        // Create token with lead permissions
        $token = $user->createToken($tokenName, [
            'leads:sync',
            'leads:validate',
            'leads:read',
        ]);

        return redirect()->route('admin.api-tokens.index')
            ->with('generated_token', $token->plainTextToken)
            ->with('token_name', $tokenName)
            ->with('success', 'New API token generated successfully! Please copy it now as it will not be shown again.');
    }

    /**
     * Revoke an API token
     */
    public function destroy(Request $request, int $id): RedirectResponse
    {
        $request->user()->tokens()->where('id', $id)->delete();

        return redirect()->route('admin.api-tokens.index')
            ->with('success', 'API token revoked successfully.');
    }
}
