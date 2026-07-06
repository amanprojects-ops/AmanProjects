<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeroSettingController extends Controller
{
    public function edit(): View
    {
        $settings = Setting::getMany([
            'hero_badge' => 'Trusted Software Partner from Bihar, India',
            'hero_title_line1' => 'We Build.',
            'hero_title_line2' => 'We Scale.',
            'hero_title_line3' => 'We Secure.',
            'hero_subtitle' => 'Custom Software, SaaS Products & Security Solutions from Bihar, India. We turn your ideas into powerful digital products that drive real business results.',
            'hero_cta1_text' => 'View Demo',
            'hero_cta1_link' => '#products',
            'hero_cta2_text' => 'View Products',
            'hero_cta2_link' => '#products',
            'hero_trust1' => '20+ Projects Delivered',
            'hero_trust2' => 'Security-First Approach',
            'hero_trust3' => 'Made in India 🇮🇳',
        ]);

        return view('admin.hero-settings.edit', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'hero_badge' => 'nullable|string|max:255',
            'hero_title_line1' => 'nullable|string|max:255',
            'hero_title_line2' => 'nullable|string|max:255',
            'hero_title_line3' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:1000',
            'hero_cta1_text' => 'nullable|string|max:255',
            'hero_cta1_link' => 'nullable|string|max:255',
            'hero_cta2_text' => 'nullable|string|max:255',
            'hero_cta2_link' => 'nullable|string|max:255',
            'hero_trust1' => 'nullable|string|max:255',
            'hero_trust2' => 'nullable|string|max:255',
            'hero_trust3' => 'nullable|string|max:255',
        ]);

        foreach ($data as $key => $value) {
            Setting::set($key, $value ?? '');
        }

        return back()->with('success', 'Hero section settings updated successfully.');
    }
}
