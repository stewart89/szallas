<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CompanyCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|regex:/^[0-9]{6}-[0-9]{4}$/',
            'foundation_date' => 'required|date_format:Y-m-d',
            'country' => 'required|string|max:255',
            'zip_code' => 'required|max:32',
            'city' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'latitude' => 'required|numeric|max:90|min:-90',
            'longitude' => 'required|numeric|max:180|min:-180',
            'owner' => 'required|string|max:255',
            'employees' => 'required|numeric',
            'activity' => 'required|string|max:255',
            'active' => 'required|boolean',
            'email' => 'required|string|email',
            'password' => 'required|string|max:255',
        ];
    }
}
