<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicalRecordUpdateRequest extends FormRequest
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
            'subjective' => ['nullable', 'max:255', 'string'],
            'objective' => ['nullable', 'max:255', 'string'],
            'assessment' => ['nullable', 'max:255', 'string'],
            'plan' => ['nullable', 'max:255', 'string'],
            'encounter_id' => ['nullable', 'exists:encounters,id'],
            'clinic_user_id' => ['nullable', 'exists:clinic_users,id'],
            'student_id' => ['nullable', 'exists:students,id'],
        ];
    }
}
