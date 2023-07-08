<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabTestRequestStoreRequest extends FormRequest
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
            'sample_collected_at' => ['nullable', 'date'],
            'sample_analyzed_at' => ['nullable', 'date'],
            'status' => ['nullable', 'max:255'],
            'notification' => ['nullable', 'max:255'],
            'note' => ['nullable', 'max:255', 'string'],
            'result' => ['nullable', 'max:255', 'string'],
            'comment' => ['nullable', 'max:255', 'string'],
            'analyser_result' => ['nullable', 'max:255', 'string'],
            'approved_at' => ['nullable', 'date'],
            'price' => ['nullable', 'numeric'],
            'sample_id' => ['nullable', 'max:255', 'string'],
            'ordered_on' => ['nullable', 'date'],
            'lab_test_request_group_id' => [
                'nullable',
                'exists:lab_test_request_groups,id',
            ],
            'sample_collected_by_id' => ['nullable', 'exists:clinic_users,id'],
            'sample_analyzed_by_id' => ['nullable', 'exists:clinic_users,id'],
            'lab_catagory_id' => ['nullable', 'exists:lab_catagories,id'],
            'approved_by_id' => ['nullable', 'exists:clinic_users,id'],
        ];
    }
}
