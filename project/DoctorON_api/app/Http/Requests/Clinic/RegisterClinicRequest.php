<?php

namespace App\Http\Requests\Clinic;

use Illuminate\Foundation\Http\FormRequest;

class RegisterClinicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<st ring, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city_id' => 'required|integer|exists:cities,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The clinic name is required.',
            'address.required' => 'The clinic address is required.',
            'city_id.required' => 'The city ID is required.',
            'city_id.exists' => 'The selected city does not exist.',
        ];
    }
}
