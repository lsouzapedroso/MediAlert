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
        return true; // Or implement your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city_id' => 'required|integer|exists:cities,id',
            'cnpj' => 'required|string|size:14|unique:clinics,cnpj',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:clinics,email',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The clinic name is required.',
            'name.string' => 'The clinic name must be a string.',
            'name.max' => 'The clinic name may not be greater than :max characters.',

            'address.required' => 'The address is required.',
            'address.string' => 'The address must be a string.',
            'address.max' => 'The address may not be greater than :max characters.',

            'city_id.required' => 'The city is required.',
            'city_id.integer' => 'The city must be a valid ID.',
            'city_id.exists' => 'The selected city is invalid.',

            'cnpj.required' => 'The CNPJ is required.',
            'cnpj.string' => 'The CNPJ must be a string.',
            'cnpj.size' => 'The CNPJ must be exactly 14 characters.',
            'cnpj.unique' => 'This CNPJ is already registered.',

            'phone.required' => 'The phone number is required.',
            'phone.string' => 'The phone number must be a string.',
            'phone.max' => 'The phone number may not be greater than :max characters.',

            'email.required' => 'The email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email may not be greater than :max characters.',
            'email.unique' => 'This email is already registered.',

        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'cnpj' => preg_replace('/[^0-9]/', '', $this->cnpj),
            'phone' => preg_replace('/[^0-9]/', '', $this->phone),
        ]);
    }
}
