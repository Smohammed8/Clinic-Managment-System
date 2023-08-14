<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequestStoreRequest extends FormRequest
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
            'amount' => ['nullable', 'numeric'],
            'product_id' => ['nullable', 'exists:products,id'],
            'store_id' => ['nullable', 'exists:stores,id'],
            'pharmacy_id' => ['nullable', 'exists:pharmacies,id'],
        ];
    }
}
