<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainDiagnosisUpdateRequest extends FormRequest
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
            'clinic_user_id' => ['nullable', 'exists:clinic_users,id'],
            'student_id' => ['nullable', 'exists:students,id'],
            'encounter_id' => ['nullable', 'exists:encounters,id'],
            'diagnosis_id' => ['required', 'exists:diagnoses,id'],
        ];
    }
}
