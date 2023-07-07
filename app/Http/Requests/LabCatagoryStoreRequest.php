<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabCatagoryStoreRequest extends FormRequest
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
            'lab_name' => ['required', 'max:255', 'string'],
            'lab_desc' => ['required', 'max:255', 'string'],
        ];
    }
}
