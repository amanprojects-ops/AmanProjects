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
        // Register Blade directive for file URLs
        \Blade::directive('fileUrl', function ($expression) {
            return "<?php echo {$expression} ? (str_starts_with({$expression}, 'uploads/') ? asset({$expression}) : asset('storage/' . {$expression})) : ''; ?>";
        });

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


        View::composer(['layouts.app', 'layouts.admin', 'admin.*', 'partials.*', 'blog.*'], function ($view) {
            if (!$view->offsetExists('settings')) {
                $view->with('settings', Setting::getMany([
                    'site_name' => 'AmanProjects',
                    'site_title' => 'AmanProjects | Home',
                    'meta_description' => '',
                    'meta_keywords' => '',
                    'favicon' => '',
                    'logo' => '',
                    'primary_color' => '#3b82f6',
                    'secondary_color' => '#1e40af',
                    'about_enabled' => true,
                    'skills_enabled' => true,
                    'projects_enabled' => true,
                    'how_we_work_enabled' => true,
                    'blog_enabled' => true,
                    'contact_enabled' => true,
                ]));
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
