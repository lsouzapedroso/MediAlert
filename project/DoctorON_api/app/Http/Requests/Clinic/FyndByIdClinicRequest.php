<?php

namespace app\Http\Requests\Clinic;

use Illuminate\Foundation\Http\FormRequest;

class FyndByIdClinicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        Return [
          'city_id' => 'required|integer|exists:cities,id',
        ];
    }

    public function messages(): array
    {
        return [
            'city_id.required' => 'The city ID is required.',
            'city_id.exists' => 'The selected city does not exist.',
            ];
    }
}
