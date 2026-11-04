<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProcessStepRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'num' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
        ];
    }
}
