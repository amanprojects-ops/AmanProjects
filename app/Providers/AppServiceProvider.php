<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Register Auth Listeners
        \Illuminate\Support\Facades\Event::listen(\Illuminate\Auth\Events\Login::class, \App\Listeners\LogSuccessfulLogin::class);
        \Illuminate\Support\Facades\Event::listen(\Illuminate\Auth\Events\Failed::class, \App\Listeners\LogFailedLogin::class);

        // Register Blade directive for file URLs
        \Blade::directive('fileUrl', function ($expression) {
            return "<?php echo \App\Helpers\FileUrlHelper::get({$expression}); ?>";
        });

        // Dynamic Mail Configuration from Database Settings
        try {
            if (Schema::hasTable('settings')) {
                $mailHost = Setting::get('mail_host');
                if (!empty($mailHost)) {
                    $encryption = Setting::get('mail_encryption', 'tls');
                    config([
                        'mail.default'                => Setting::get('mail_mailer', 'smtp'),
                        'mail.mailers.smtp.transport' => 'smtp',
                        'mail.mailers.smtp.host'      => $mailHost,
                        'mail.mailers.smtp.port'      => (int) Setting::get('mail_port', 587),
                        'mail.mailers.smtp.encryption'=> ($encryption === 'none' || empty($encryption)) ? null : $encryption,
                        'mail.mailers.smtp.username'  => Setting::get('mail_username'),
                        'mail.mailers.smtp.password'  => Setting::get('mail_password'),
                        'mail.from.address'           => Setting::get('mail_from_address', config('mail.from.address')),
                        'mail.from.name'              => Setting::get('mail_from_name', Setting::get('site_name', config('mail.from.name'))),
                    ]);
                }
            }
        } catch (\Throwable $e) {
            // Silently fallback to default environment mail config if table or connection is not ready
        }

        // Clear home page cache automatically for specific models
        $cacheMap = [
            \App\Models\Setting::class       => 'ap_settings',
            \App\Models\User::class          => 'ap_user_data',
            \App\Models\Profile::class       => 'ap_user_data',
            \App\Models\SocialLink::class    => 'ap_user_data',
            \App\Models\Skill::class         => 'ap_skills',
            \App\Models\Project::class       => 'ap_projects',
            \App\Models\Album::class         => 'ap_projects', // Albums relate to projects
            \App\Models\AlbumImage::class    => 'ap_projects',
            \App\Models\Post::class          => 'ap_posts',
            \App\Models\Category::class      => 'ap_posts',    // Categories affect post layout
            \App\Models\Stat::class          => 'ap_stats',
            \App\Models\Service::class       => 'ap_services',
            \App\Models\Plan::class          => 'ap_plans',
            \App\Models\Testimonial::class   => 'ap_testimonials',
            \App\Models\WhyChooseUs::class   => 'ap_whys',
            \App\Models\ProcessStep::class   => 'ap_steps',
        ];

        foreach ($cacheMap as $modelClass => $cacheKey) {
            if (class_exists($modelClass)) {
                $flush = function () use ($cacheKey) {
                    if (class_exists(\App\Http\Controllers\HomeController::class)) {
                        \App\Http\Controllers\HomeController::flushCache($cacheKey);
                    }
                };
                $modelClass::saved($flush);
                $modelClass::deleted($flush);
            }
        }

        View::composer('*', function ($view) {
            if (!$view->offsetExists('settings')) {
                $settings = \Illuminate\Support\Facades\Cache::remember('ap_settings', now()->addMinutes(60), function () {
                    return \App\Models\Setting::getMany([
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

                        // Feature & Section Visibility
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
                });
                $view->with('settings', $settings);
            }

            if (!$view->offsetExists('socialLinks')) {
                try {
                    if (Schema::hasTable('users') && Schema::hasTable('social_links')) {
                        $user = User::first();
                        $view->with('socialLinks', $user ? $user->socialLinks()->where('is_active', true)->get() : collect());
                    } else {
                        $view->with('socialLinks', collect());
                    }
                } catch (\Exception $e) {
                    $view->with('socialLinks', collect());
                }
            }
        });
    }
}
