<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        /** Kihagyjuk a foundation_date mezőt igy ebben az updateben sosem fog lefutni */
        return [
            'name' => 'string|max:255',
            'registration_number' => 'string|regex:/^[0-9]{6}-[0-9]{4}$/',
            'country' => 'string|max:255',
            'zip_code' => 'max:32',
            'city' => 'string|max:255',
            'street_address' => 'string|max:255',
            'latitude' => 'numeric|max:90|min:-90',
            'longitude' => 'numeric|max:180|min:-180',
            'owner' => 'string|max:255',
            'employees' => 'numeric',
            'activity' => 'string|max:255',
            'active' => 'boolean',
            'email' => 'string|email',
            'password' => 'string|max:255',
        ];
    }
}
