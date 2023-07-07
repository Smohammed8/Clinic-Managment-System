<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VitalSignUpdateRequest extends FormRequest
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
            'temp' => ['nullable', 'numeric'],
            'blood_pressure ' => ['nullable', 'numeric'],
            'pulse_rate' => ['nullable', 'numeric'],
            'rr' => ['nullable', 'numeric'],
            'weight' => ['nullable', 'numeric'],
            'height' => ['nullable', 'numeric'],
            'muac' => ['nullable', 'numeric'],
            'encounter_id' => ['required', 'exists:encounters,id'],
            'clinic_user_id' => ['required', 'exists:clinic_users,id'],
            'student_id' => ['required', 'exists:student,id'],
        ];
    }
}
