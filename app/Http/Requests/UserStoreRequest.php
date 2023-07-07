<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'username' => [
                'nullable',
                'unique:users,username',
                'max:255',
                'string',
            ],
            'email' => ['nullable', 'unique:users,email', 'email'],
            'password' => ['nullable'],
            'roles' => 'array',
        ];
    }
}
