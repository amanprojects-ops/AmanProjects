<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $serviceId = $this->route('service') ? $this->route('service')->id : null;

        return [
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255|unique:services,slug,' . $serviceId,
            'tagline'          => 'nullable|string|max:255',
            'badge'            => 'nullable|string|max:100',
            'desc'             => 'nullable|string',
            'content'          => 'nullable|string',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords'    => 'nullable|string',
            'features'         => 'nullable',
            'pricing_tiers'    => 'nullable',
            'process_steps'    => 'nullable',
            'faqs'             => 'nullable',
            'color'            => 'nullable|string|max:255',
            'bg'               => 'nullable|string|max:255',
            'icon_path'        => 'nullable|string',
            'is_active'        => 'nullable',
            'sort_order'       => 'nullable|integer',
        ];
    }
}
