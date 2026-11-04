<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:10000',
            'tech_stack_tags' => 'nullable|string|max:500',
            'github_link' => 'nullable|url|max:500',
            'live_demo_link' => 'nullable|url|max:500',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'featured' => 'boolean',
            'status' => 'required|in:draft,published',
        ];
    }
}
