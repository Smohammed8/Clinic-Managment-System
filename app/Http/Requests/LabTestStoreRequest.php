<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabTestStoreRequest extends FormRequest
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
            'test_name' => ['nullable', 'max:255', 'string'],
            'test_desc' => ['nullable', 'max:255', 'string'],
            'lab_catagory_id' => ['nullable', 'exists:lab_catagories,id'],
            'status' => ['nullable', 'max:255'],
            'is_available' => ['nullable', 'boolean'],
            'price' => ['nullable', 'numeric'],
        ];
    }
}
