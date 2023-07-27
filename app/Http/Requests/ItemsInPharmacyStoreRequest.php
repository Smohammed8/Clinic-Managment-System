<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemsInPharmacyStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'item_id' => ['nullable', 'exists:items,id'],
            'count' => ['nullable', 'numeric'],
            'pharmacy_id' => ['required', 'exists:pharmacies,id'],
        ];
    }
}
