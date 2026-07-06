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
            'site_name' => 'nullable|string|max:255',
            'site_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'favicon' => 'nullable|image|mimes:ico,png|max:512',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:1024',
            'maintenance_mode' => 'boolean',
            'primary_color' => 'nullable|string|max:20',
            'secondary_color' => 'nullable|string|max:20',
            'about_enabled' => 'boolean',
            'skills_enabled' => 'boolean',
            'projects_enabled' => 'boolean',
            'experience_enabled' => 'boolean',
            'education_enabled' => 'boolean',
            'blog_enabled' => 'boolean',
            'contact_enabled' => 'boolean',
            'local_business_address' => 'nullable|string|max:500',
            'local_business_phone' => 'nullable|string|max:100',
            'local_business_email' => 'nullable|email|max:255',
            'local_business_lat' => 'nullable|string|max:100',
            'local_business_lng' => 'nullable|string|max:100',
        ];
    }

}
