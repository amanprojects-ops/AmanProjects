<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServicesSettingController extends Controller
{
    public function edit(): View
    {
        $settings = Setting::getMany([
            'services_badge' => 'What We Do',
            'services_title' => 'Our Services',
            'services_subtitle' => 'We deliver end-to-end digital solutions tailored for startups, SMBs, and enterprises — built for performance, security, and scale.',
            'services_cta_title' => 'Need Something Custom?',
            'services_cta_desc' => 'Every great product starts with a conversation. Let\'s discuss yours.',
            'services_cta_btn_text' => 'Start a Project',
            'services_cta_btn_link' => '#contact',
        ]);

        return view('admin.services-settings.edit', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'services_badge' => 'nullable|string|max:255',
            'services_title' => 'nullable|string|max:255',
            'services_subtitle' => 'nullable|string|max:1000',
            'services_cta_title' => 'nullable|string|max:255',
            'services_cta_desc' => 'nullable|string|max:1000',
            'services_cta_btn_text' => 'nullable|string|max:255',
            'services_cta_btn_link' => 'nullable|string|max:255',
        ]);

        foreach ($data as $key => $value) {
            Setting::set($key, $value ?? '');
        }

        return back()->with('success', 'Services section settings updated successfully.');
    }
}
