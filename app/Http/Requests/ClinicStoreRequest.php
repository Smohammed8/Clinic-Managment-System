<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClinicStoreRequest extends FormRequest
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
            'code_clinic' => ['nullable', 'max:255', 'string'],
            'description' => ['nullable', 'max:255', 'string'],
            'lat' => ['nullable', 'numeric'],
            'long' => ['nullable', 'numeric'],
            'campus_id' => ['nullable', 'exists:campus,id'],
            'collage_id' => ['nullable', 'exists:collage,id'],
            'status' => ['nullable', 'max:255'],
            'is_active' => ['nullable', 'max:255'],
        ];
    }
}
