<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class SyncLeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'batch_metadata'                     => 'nullable|array',
            'batch_metadata.client_name'         => 'nullable|string|max:50',
            'batch_metadata.client_version'      => 'nullable|string|max:20',
            'batch_metadata.keyword'             => 'nullable|string|max:255',
            'batch_metadata.captured_at'         => 'nullable|date',

            'leads'                              => 'required|array|min:1|max:250',
            'leads.*.business_name'              => 'required|string|max:255',
            'leads.*.category'                   => 'nullable|string|max:100',
            'leads.*.website'                    => 'nullable|string|max:255',
            'leads.*.primary_phone'              => 'nullable|string|max:50',
            'leads.*.primary_email'              => 'nullable|string|max:150',
            'leads.*.address'                    => 'nullable|string|max:500',
            'leads.*.latitude'                   => 'nullable|numeric|between:-90,90',
            'leads.*.longitude'                  => 'nullable|numeric|between:-180,180',
            'leads.*.google_place_id'            => 'nullable|string|max:255',
            'leads.*.google_cid'                 => 'nullable|string|max:100',
            'leads.*.rating'                     => 'nullable|numeric|between:0,5',
            'leads.*.review_count'               => 'nullable|integer|min:0',
            'leads.*.provenance_source'          => 'nullable|string|max:50',
            'leads.*.provenance_url'             => 'nullable|string|max:500',

            'leads.*.contacts'                   => 'nullable|array',
            'leads.*.contacts.*.type'            => 'required_with:leads.*.contacts|string|in:email,phone,mobile,whatsapp',
            'leads.*.contacts.*.value'           => 'required_with:leads.*.contacts|string|max:255',
            'leads.*.contacts.*.is_primary'      => 'nullable|boolean',

            'leads.*.social_profiles'            => 'nullable|array',
            'leads.*.social_profiles.*.platform' => 'required_with:leads.*.social_profiles|string|in:instagram,facebook,linkedin,twitter,youtube,yelp,other',
            'leads.*.social_profiles.*.profile_url' => 'required_with:leads.*.social_profiles|string|max:500',
        ];
    }
}
