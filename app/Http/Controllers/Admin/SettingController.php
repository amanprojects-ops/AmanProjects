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
            'site_name' => '',
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
            'how_we_work_enabled' => true,
            'blog_enabled' => true,
            'contact_enabled' => true,
            'local_business_address' => '',
            'local_business_phone' => '',
            'local_business_email' => '',
            'local_business_lat' => '',
            'local_business_lng' => '',
        ]);

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(SettingRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('favicon')) {
            try {
                $oldFavicon = Setting::get('favicon');
                if ($oldFavicon) {
                    $this->deleteFile($oldFavicon);
                }
                $data['favicon'] = \App\Helpers\FileHelper::uploadPublicPath(
                    $request->file('favicon'),
                    'uploads/icons'
                );
            } catch (\Exception $e) {
                return back()->withErrors(['favicon' => $e->getMessage()]);
            }
        }

        if ($request->hasFile('logo')) {
            try {
                $oldLogo = Setting::get('logo');
                if ($oldLogo) {
                    $this->deleteFile($oldLogo);
                }
                $data['logo'] = \App\Helpers\FileHelper::uploadPublicPath(
                    $request->file('logo'),
                    'uploads/icons'
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

    public function flushCache(): RedirectResponse
    {
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        
        // Also call our specific home cache flusher just in case we switch cache drivers
        if (class_exists(\App\Http\Controllers\HomeController::class)) {
            \App\Http\Controllers\HomeController::flushCache();
        }

        return back()->with('success', 'Application cache flushed successfully!');
    }
}
