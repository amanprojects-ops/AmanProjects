<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => $this->name ? strip_tags($this->name) : null,
            'subject' => $this->subject ? strip_tags($this->subject) : null,
            'message' => $this->message ? strip_tags($this->message) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
            'honeypot' => 'nullable|max:0',
        ];
    }
}
