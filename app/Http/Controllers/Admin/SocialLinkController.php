<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SocialLinkRequest;
use App\Models\SocialLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SocialLinkController extends Controller
{
    public function index(): View
    {
        $socialLinks = auth()->user()->socialLinks;
        return view('admin.social-links.index', compact('socialLinks'));
    }

    public function create(): View
    {
        $socialLink = new SocialLink();
        return view('admin.social-links.create', compact('socialLink'));
    }

    public function store(SocialLinkRequest $request): RedirectResponse
    {
        auth()->user()->socialLinks()->create($request->validated());
        return redirect()->route('admin.social-links.index')->with('success', 'Social link created successfully.');
    }

    public function edit(SocialLink $socialLink): View
    {
        $this->authorizeOwnership($socialLink);
        return view('admin.social-links.edit', compact('socialLink'));
    }

    public function update(SocialLinkRequest $request, SocialLink $socialLink): RedirectResponse
    {
        $this->authorizeOwnership($socialLink);
        $socialLink->update($request->validated());
        return redirect()->route('admin.social-links.index')->with('success', 'Social link updated successfully.');
    }

    public function destroy(SocialLink $socialLink): RedirectResponse
    {
        $this->authorizeOwnership($socialLink);
        $socialLink->delete();
        return redirect()->route('admin.social-links.index')->with('success', 'Social link deleted successfully.');
    }

    private function authorizeOwnership(SocialLink $socialLink): void
    {
        if ($socialLink->user_id !== auth()->id() && !auth()->user()->isSuperAdmin()) {
            abort(403, 'Unauthorized access.');
        }
    }
}
