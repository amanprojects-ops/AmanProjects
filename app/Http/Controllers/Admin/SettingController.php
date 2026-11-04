<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use App\Traits\HandlesFileUploads;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class SettingController extends Controller
{
    use HandlesFileUploads;

    /**
     * Display the System Manager settings interface with diagnostic stats.
     */
    public function edit(): View
    {
        $settings = Setting::getMany([
            // General
            'site_name'                  => 'AmanProjects',
            'site_title'                 => 'AmanProjects | Custom Software & Web Development in Saharsa, Bihar',
            'site_tagline'               => 'Innovating Digital Solutions & Web Platforms',
            'site_copyright'             => '© ' . date('Y') . ' AmanProjects. All rights reserved.',
            'whatsapp_number'            => '+91 9876543210',
            'local_business_address'     => 'Saharsa, Bihar, India',
            'local_business_locality'    => 'Saharsa',
            'local_business_region'      => 'Bihar',
            'local_business_postal_code' => '852201',
            'local_business_country'     => 'India',
            'local_business_phone'       => '+91 9876543210',
            'local_business_email'       => 'contact@amanprojects.com',
            'local_business_lat'         => '25.0961',
            'local_business_lng'         => '85.3131',

            // Branding & Colors
            'primary_color'              => '#3b82f6',
            'secondary_color'            => '#1e40af',
            'favicon'                    => '',
            'apple_touch_icon'           => '',
            'logo'                       => '',
            'logo_dark'                  => '',
            'og_image'                   => '',

            // SEO & Social Meta
            'meta_description'           => 'AmanProjects (Aman Saharsa) is a leading software company based in Saharsa, Bihar. Delivering custom web development, SaaS, and cybersecurity solutions.',
            'meta_keywords'              => 'aman projects, aman saharsa, software company saharsa, web development bihar, php laravel developer',
            'meta_author'                => 'AmanProjects',
            'meta_robots'                => 'index, follow, max-snippet:-1, max-image-preview:large',
            'og_title'                   => '',
            'og_description'             => '',
            'twitter_card_type'          => 'summary_large_image',
            'twitter_creator'            => '@AmanProjects',
            'google_site_verification'   => '',
            'bing_site_verification'     => '',
            'google_analytics_id'        => '',
            'google_tag_manager_id'      => '',
            'custom_head_scripts'        => '',
            'custom_footer_scripts'      => '',

            // Email & SMTP
            'mail_mailer'                => 'smtp',
            'mail_host'                  => '',
            'mail_port'                  => '587',
            'mail_username'              => '',
            'mail_password'              => '',
            'mail_encryption'            => 'tls',
            'mail_from_address'          => 'noreply@amanprojects.com',
            'mail_from_name'             => 'AmanProjects',
            'mail_enable_notifications'  => true,

            // Section Toggles
            'about_enabled'              => true,
            'skills_enabled'             => true,
            'projects_enabled'           => true,
            'how_we_work_enabled'        => true,
            'blog_enabled'               => true,
            'contact_enabled'            => true,
            'stats_enabled'              => true,
            'services_enabled'           => true,
            'pricing_enabled'            => true,
            'testimonials_enabled'       => true,
            'why_us_enabled'             => true,

            // Maintenance
            'maintenance_mode'           => false,
            'maintenance_title'          => 'We’ll be right back!',
            'maintenance_message'        => 'Our website is currently undergoing scheduled maintenance. Please check back shortly.',
        ]);

        // System Diagnostic Information
        $diagnostics = [
            'php_version'        => PHP_VERSION,
            'laravel_version'    => app()->version(),
            'server_software'    => $_SERVER['SERVER_SOFTWARE'] ?? php_uname('s'),
            'memory_limit'       => ini_get('memory_limit'),
            'upload_max_size'    => ini_get('upload_max_filesize'),
            'post_max_size'      => ini_get('post_max_size'),
            'max_execution_time' => ini_get('max_execution_time') . 's',
            'cache_driver'       => config('cache.default'),
            'mail_driver'        => config('mail.default'),
            'database_connected' => true,
            'database_name'      => '',
        ];

        try {
            $diagnostics['database_name'] = DB::connection()->getDatabaseName();
        } catch (\Throwable $e) {
            $diagnostics['database_connected'] = false;
            $diagnostics['database_name'] = 'Error: ' . $e->getMessage();
        }

        return view('admin.settings.edit', compact('settings', 'diagnostics'));
    }

    /**
     * Update system settings and handle media asset uploads/deletions.
     */
    public function update(SettingRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $fileKeys = ['favicon', 'apple_touch_icon', 'logo', 'logo_dark', 'og_image'];

        // Handle explicit file removal requests
        foreach ($fileKeys as $fKey) {
            $removeFlag = 'remove_' . $fKey;
            if ($request->boolean($removeFlag)) {
                $oldPath = Setting::get($fKey);
                if ($oldPath) {
                    $this->deleteFile($oldPath);
                }
                Setting::set($fKey, '');
                unset($data[$fKey]);
            }
        }

        // Handle File Uploads
        foreach ($fileKeys as $fileKey) {
            if ($request->hasFile($fileKey)) {
                try {
                    $oldPath = Setting::get($fileKey);
                    if ($oldPath) {
                        $this->deleteFile($oldPath);
                    }
                    
                    $uploadDir = in_array($fileKey, ['favicon', 'apple_touch_icon', 'logo', 'logo_dark']) 
                        ? 'uploads/icons' 
                        : 'uploads/seo';

                    $data[$fileKey] = \App\Helpers\FileHelper::uploadPublicPath(
                        $request->file($fileKey),
                        $uploadDir
                    );
                } catch (\Exception $e) {
                    return back()->withErrors([$fileKey => 'Failed to upload ' . $fileKey . ': ' . $e->getMessage()]);
                }
            }
        }

        // Explicit boolean toggle keys that default to false if unchecked
        $booleanKeys = [
            'about_enabled',
            'skills_enabled',
            'projects_enabled',
            'how_we_work_enabled',
            'blog_enabled',
            'contact_enabled',
            'stats_enabled',
            'services_enabled',
            'pricing_enabled',
            'testimonials_enabled',
            'why_us_enabled',
            'maintenance_mode',
            'mail_enable_notifications',
        ];

        foreach ($booleanKeys as $bKey) {
            $data[$bKey] = $request->boolean($bKey);
        }

        // Save all data keys to the Setting model
        foreach ($data as $key => $value) {
            if (str_starts_with($key, 'remove_')) {
                continue;
            }
            if (in_array($key, $fileKeys) && !$request->hasFile($key) && !isset($data[$key])) {
                continue;
            }
            Setting::set($key, $value);
        }

        // Clear application and home view caches
        $this->clearSystemCache();

        $activeTab = $request->input('active_tab', 'general');

        return redirect()
            ->to(route('admin.settings.edit') . '#' . $activeTab)
            ->with('success', 'System settings updated successfully.');
    }

    /**
     * Test SMTP configuration dynamically by sending a real test email.
     */
    public function testEmail(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'test_email' => 'required|email|max:255',
        ]);

        $recipient = $request->input('test_email');

        // Allow passing immediate overrides from request or fallback to stored DB settings
        $mailer      = $request->input('mail_mailer', Setting::get('mail_mailer', 'smtp'));
        $host        = $request->input('mail_host', Setting::get('mail_host'));
        $port        = (int) $request->input('mail_port', Setting::get('mail_port', 587));
        $encryption  = $request->input('mail_encryption', Setting::get('mail_encryption', 'tls'));
        $username    = $request->input('mail_username', Setting::get('mail_username'));
        $password    = $request->input('mail_password', Setting::get('mail_password'));
        $fromAddress = $request->input('mail_from_address', Setting::get('mail_from_address', 'noreply@amanprojects.com'));
        $fromName    = $request->input('mail_from_name', Setting::get('mail_from_name', Setting::get('site_name', 'AmanProjects')));

        if (empty($host) && $mailer === 'smtp') {
            $errorMsg = 'SMTP Host is missing. Please provide a valid SMTP Host before sending a test email.';
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $errorMsg], 422);
            }
            return back()->withErrors(['test_email' => $errorMsg]);
        }

        try {
            // Apply dynamic runtime configuration
            config([
                'mail.default'                       => $mailer,
                'mail.mailers.smtp.transport'         => 'smtp',
                'mail.mailers.smtp.host'              => $host,
                'mail.mailers.smtp.port'              => $port,
                'mail.mailers.smtp.encryption'        => ($encryption === 'none' || empty($encryption)) ? null : $encryption,
                'mail.mailers.smtp.username'          => $username,
                'mail.mailers.smtp.password'          => $password,
                'mail.mailers.smtp.timeout'           => 10,
                'mail.from.address'                  => $fromAddress,
                'mail.from.name'                     => $fromName,
            ]);

            // Purge existing mail manager instance to ensure fresh connection with new configs
            app()->forgetInstance('mail.manager');

            $siteName = Setting::get('site_name', 'AmanProjects');
            $sentTime = now()->toDayDateTimeString();

            Mail::raw(
                "Hello!\n\nThis is a test email sent from your {$siteName} System Manager.\n\n" .
                "SMTP Settings Tested:\n" .
                "- Host: {$host}\n" .
                "- Port: {$port}\n" .
                "- Encryption: " . ($encryption ?: 'None') . "\n" .
                "- From: {$fromName} <{$fromAddress}>\n" .
                "- Timestamp: {$sentTime}\n\n" .
                "If you are seeing this message, your email SMTP configuration is working perfectly!",
                function ($message) use ($recipient, $siteName, $fromAddress, $fromName) {
                    $message->to($recipient)
                            ->from($fromAddress, $fromName)
                            ->subject("✓ [Test Email] SMTP Configuration Verified — {$siteName}");
                }
            );

            $successMsg = "Success! Test email was successfully delivered to {$recipient}.";

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $successMsg,
                ]);
            }

            return redirect()
                ->to(route('admin.settings.edit') . '#smtp')
                ->with('success', $successMsg);

        } catch (\Throwable $e) {
            $errorMsg = 'SMTP Connection Failed: ' . $e->getMessage();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMsg,
                ], 500);
            }

            return redirect()
                ->to(route('admin.settings.edit') . '#smtp')
                ->withErrors(['test_email' => $errorMsg]);
        }
    }

    /**
     * Flush all application caches (Artisan cache, config, routes, views, and HomeController cache).
     */
    public function flushCache(): RedirectResponse
    {
        $this->clearSystemCache();

        return redirect()
            ->to(route('admin.settings.edit') . '#system')
            ->with('success', 'Application cache, view cache, and system tokens flushed successfully!');
    }

    /**
     * Internal helper to clear all application and settings caches.
     */
    protected function clearSystemCache(): void
    {
        Setting::clearCache();

        try {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');
        } catch (\Throwable $e) {
            // Silently log or ignore in environments with restricted permissions
        }

        if (class_exists(\App\Http\Controllers\HomeController::class)) {
            \App\Http\Controllers\HomeController::flushCache();
        }
    }
}
