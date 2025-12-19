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

        View::composer(['layouts.app', 'partials.*', 'blog.*'], function ($view) {
            if (!$view->offsetExists('settings')) {
                $view->with('settings', Setting::getMany([
                    'site_title' => 'Portfolio',
                    'meta_description' => '',
                    'meta_keywords' => '',
                    'favicon' => '',
                    'logo' => '',
                    'primary_color' => '#3b82f6',
                    'secondary_color' => '#1e40af',
                    'about_enabled' => true,
                    'skills_enabled' => true,
                    'projects_enabled' => true,
                    'experience_enabled' => true,
                    'education_enabled' => true,
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
