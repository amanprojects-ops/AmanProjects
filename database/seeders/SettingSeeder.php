<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'AmanProjects',
            'site_title' => 'AmanProjects | Home',
            'meta_description' => 'Personal portfolio website',
            'meta_keywords' => 'portfolio, developer, web development',
            'favicon' => '',
            'logo' => '',
            'maintenance_mode' => '0',
            'primary_color' => '#3b82f6',
            'secondary_color' => '#1e40af',
            'about_enabled' => '1',
            'skills_enabled' => '1',
            'projects_enabled' => '1',
            'how_we_work_enabled' => '1',
            'blog_enabled' => '1',
            'contact_enabled' => '1',
            'stats_enabled' => '1',
            'services_enabled' => '1',
            'pricing_enabled' => '1',
            'testimonials_enabled' => '1',
            'why_us_enabled' => '1',
        ];

        foreach ($settings as $key => $value) {
            Setting::firstOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
