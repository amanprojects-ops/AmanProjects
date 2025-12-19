<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_title' => 'My Portfolio',
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
            'experience_enabled' => '1',
            'education_enabled' => '1',
            'blog_enabled' => '1',
            'contact_enabled' => '1',
        ];

        foreach ($settings as $key => $value) {
            Setting::firstOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
