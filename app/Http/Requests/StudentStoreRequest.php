<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'first_name' => ['nullable', 'max:255', 'string'],
            'middle_name' => ['nullable', 'max:255', 'string'],
            'last_name' => ['nullable', 'max:255', 'string'],
            'sex' => ['nullable', 'in:male,female,other'],
            'photo' => ['nullable', 'file'],
            'id_number' => ['nullable', 'max:255', 'string'],
            'encounter_id' => ['nullable', 'exists:encounters,id'],
        ];
    }
}
