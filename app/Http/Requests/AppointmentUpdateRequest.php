<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentUpdateRequest extends FormRequest
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
            'a_date' => ['nullable', 'date'],
            'reason' => ['nullable', 'max:255', 'string'],
            'status' => ['nullable', 'max:255'],
            'encounter_id' => ['nullable', 'boolean', 'exists:encounters,id'],
            'clinic_user_id' => ['nullable', 'exists:clinic_users,id'],
            'student_id' => ['required', 'exists:students,id'],
        ];
    }
}
