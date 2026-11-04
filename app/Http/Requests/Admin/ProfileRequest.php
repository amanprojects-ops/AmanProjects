<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:5000',
            'phone' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'resume' => 'nullable|mimes:pdf|max:5120',
        ];
    }
}
