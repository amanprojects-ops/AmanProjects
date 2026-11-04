<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // General & Website Information
            'site_name' => 'nullable|string|max:255',
            'site_title' => 'nullable|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'site_copyright' => 'nullable|string|max:255',
            'whatsapp_number' => 'nullable|string|max:50',
            'local_business_address' => 'nullable|string|max:500',
            'local_business_locality' => 'nullable|string|max:100',
            'local_business_region' => 'nullable|string|max:100',
            'local_business_postal_code' => 'nullable|string|max:20',
            'local_business_country' => 'nullable|string|max:100',
            'local_business_phone' => 'nullable|string|max:100',
            'local_business_email' => 'nullable|email|max:255',
            'local_business_lat' => 'nullable|string|max:100',
            'local_business_lng' => 'nullable|string|max:100',
            // Branding & Colors
            'primary_color'           => 'nullable|string|max:20',
            'secondary_color'         => 'nullable|string|max:20',
            'favicon'                 => 'nullable|file|max:2048',
            'apple_touch_icon'        => 'nullable|file|mimes:png,jpg,jpeg,webp|max:2048',
            'logo'                    => 'nullable|file|mimes:jpeg,png,jpg,svg,webp,gif|max:4096',
            'logo_dark'               => 'nullable|file|mimes:jpeg,png,jpg,svg,webp,gif|max:4096',
            'og_image'                => 'nullable|file|mimes:jpeg,png,jpg,webp,gif|max:4096',
            'remove_favicon'          => 'nullable|boolean',
            'remove_apple_touch_icon' => 'nullable|boolean',
            'remove_logo'             => 'nullable|boolean',
            'remove_logo_dark'        => 'nullable|boolean',
            'remove_og_image'         => 'nullable|boolean',
            // SEO & Social Meta
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'meta_author' => 'nullable|string|max:255',
            'meta_robots' => 'nullable|string|max:100',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'twitter_card_type' => 'nullable|string|in:summary,summary_large_image',
            'twitter_creator' => 'nullable|string|max:100',
            'google_site_verification' => 'nullable|string|max:255',
            'bing_site_verification' => 'nullable|string|max:255',
            'google_analytics_id' => 'nullable|string|max:50',
            'google_tag_manager_id' => 'nullable|string|max:50',
            'custom_head_scripts' => 'nullable|string|max:10000',
            'custom_footer_scripts' => 'nullable|string|max:10000',
            // Email & SMTP Configuration
            'mail_mailer' => 'nullable|string|in:smtp,sendmail,log',
            'mail_host' => 'nullable|string|max:255',
            'mail_port' => 'nullable|numeric|between:1,65535',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|string|max:255',
            'mail_encryption' => 'nullable|string|in:tls,ssl,none',
            'mail_from_address' => 'nullable|email|max:255',
            'mail_from_name' => 'nullable|string|max:255',
            'mail_enable_notifications' => 'nullable|boolean',
            // Feature & Section Visibility
            'about_enabled' => 'nullable|boolean',
            'skills_enabled' => 'nullable|boolean',
            'projects_enabled' => 'nullable|boolean',
            'how_we_work_enabled' => 'nullable|boolean',
            'blog_enabled' => 'nullable|boolean',
            'contact_enabled' => 'nullable|boolean',
            'stats_enabled' => 'nullable|boolean',
            'services_enabled' => 'nullable|boolean',
            'pricing_enabled' => 'nullable|boolean',
            'testimonials_enabled' => 'nullable|boolean',
            'why_us_enabled' => 'nullable|boolean',
            // Maintenance Mode
            'maintenance_mode' => 'nullable|boolean',
            'maintenance_title' => 'nullable|string|max:255',
            'maintenance_message' => 'nullable|string|max:1000',
        ];
    }
}
