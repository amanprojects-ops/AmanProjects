<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'period' => 'nullable|string|max:255',
            'desc' => 'nullable|string',
            'color' => 'nullable|string|max:100',
            'btn_style' => 'nullable|string|max:100',
            'featured' => 'boolean',
            'features' => 'nullable|string',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'featured' => $this->has('featured') ? true : false,
        ]);
    }
}
