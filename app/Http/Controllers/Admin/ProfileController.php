<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Models\Profile;
use App\Traits\HandlesFileUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use HandlesFileUploads;
    public function edit(): View
    {
        $user = auth()->user();
        $profile = $user->profile ?? new Profile();

        return view('admin.profile.edit', compact('user', 'profile'));
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $data = $request->validated();

        $user->update(['name' => $data['name']]);

        $profileData = [
            'title' => $data['title'],
            'bio' => $data['bio'],
            'phone' => $data['phone'] ?? null,
            'location' => $data['location'] ?? null,
            'website' => $data['website'] ?? null,
        ];

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            try {
                $profileData['profile_image'] = $this->uploadFile(
                    $request->file('profile_image'),
                    'profiles',
                    $user->profile?->profile_image
                );
            } catch (\Exception $e) {
                return back()->withErrors(['profile_image' => $e->getMessage()]);
            }
        }

        // Handle resume upload
        if ($request->hasFile('resume')) {
            try {
                $profileData['resume'] = $this->uploadFile(
                    $request->file('resume'),
                    'misc',
                    $user->profile?->resume
                );
            } catch (\Exception $e) {
                return back()->withErrors(['resume' => $e->getMessage()]);
            }
        }

        $user->profile()->updateOrCreate(['user_id' => $user->id], $profileData);

        return back()->with('success', 'Profile updated successfully.');
    }
}
