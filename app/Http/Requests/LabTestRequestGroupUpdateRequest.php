<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabTestRequestGroupUpdateRequest extends FormRequest
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
            'status' => ['nullable', 'max:255'],
            'priority' => ['nullable', 'max:255'],
            'notification' => ['nullable', 'max:255'],
            'call_status' => ['nullable', 'max:255'],
            'requested_at' => ['nullable', 'date'],
            'clinic_user_id' => ['nullable', 'exists:clinic_users,id'],
            'encounter_id' => ['nullable', 'exists:encounters,id'],
        ];
    }
}
