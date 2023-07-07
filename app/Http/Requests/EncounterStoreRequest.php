<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EncounterStoreRequest extends FormRequest
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
            'check_in_time' => ['nullable', 'date'],
            'status' => ['nullable', 'max:255'],
            'closed_at' => ['nullable', 'date'],
            'priority' => ['nullable', 'max:255'],
            'clinic_id' => ['nullable', 'exists:clinic,id'],
        ];
    }
}
