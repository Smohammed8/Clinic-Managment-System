<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockStoreRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'quantitiy_recived' => ['nullable', 'max:255', 'string'],
            'quantity_despensed' => ['nullable', 'max:255', 'string'],
            'bach_no' => ['nullable', 'max:255', 'string'],
            'expire_date' => ['nullable', 'date'],
            'pack' => ['nullable', 'max:255', 'string'],
            'quantity_per_pack' => ['nullable', 'max:255', 'string'],
            'basic_unit_quantity' => ['nullable', 'max:255', 'string'],
            'pack_price' => ['nullable', 'max:255', 'string'],
            'stock_category_id' => ['nullable', 'exists:stock_categories,id'],
            'stock_unit_id' => ['nullable', 'exists:stock_units,id'],
            'supplier_id' => ['nullable', 'exists:suppliers,id'],
        ];
    }
}
