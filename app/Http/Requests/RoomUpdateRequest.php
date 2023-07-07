<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomUpdateRequest extends FormRequest
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
            'name' => ['nullable', 'max:255', 'string'],
            'description' => ['nullable', 'max:255', 'string'],
            'status' => ['nullable', 'max:255'],
            'is_active' => ['nullable', 'max:255'],
            'clinic_id' => ['nullable', 'exists:clinic,id'],
            'encounter_id' => ['nullable', 'exists:encounters,id'],
            'clinicUsers' => ['array'],
        ];
    }
}
