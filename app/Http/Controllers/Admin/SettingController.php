<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use App\Traits\HandlesFileUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    use HandlesFileUploads;
    public function edit(): View
    {
        $settings = Setting::getMany([
            'site_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'favicon' => '',
            'logo' => '',
            'maintenance_mode' => false,
            'primary_color' => '#3b82f6',
            'secondary_color' => '#1e40af',
            'about_enabled' => true,
            'skills_enabled' => true,
            'projects_enabled' => true,
            'experience_enabled' => true,
            'education_enabled' => true,
            'blog_enabled' => true,
            'contact_enabled' => true,
        ]);

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(SettingRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('favicon')) {
            try {
                $data['favicon'] = $this->uploadFile(
                    $request->file('favicon'),
                    'misc',
                    Setting::get('favicon')
                );
            } catch (\Exception $e) {
                return back()->withErrors(['favicon' => $e->getMessage()]);
            }
        }

        if ($request->hasFile('logo')) {
            try {
                $data['logo'] = $this->uploadFile(
                    $request->file('logo'),
                    'misc',
                    Setting::get('logo')
                );
            } catch (\Exception $e) {
                return back()->withErrors(['logo' => $e->getMessage()]);
            }
        }

        foreach ($data as $key => $value) {
            if (!in_array($key, ['favicon', 'logo']) || $request->hasFile($key)) {
                Setting::set($key, $value ?? false);
            }
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
