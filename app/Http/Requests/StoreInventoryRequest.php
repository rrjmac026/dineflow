<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'item_name' => ['required', 'string', 'max:255', 'unique:inventories,item_name'],
            'quantity' => ['required', 'integer', 'min:0'],
            'supplier' => ['required', 'string', 'max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'item_name.required' => 'Item name is required',
            'item_name.unique' => 'This item already exists in inventory',
            'quantity.required' => 'Please specify the quantity',
            'quantity.integer' => 'Quantity must be a whole number',
            'quantity.min' => 'Quantity cannot be negative',
            'supplier.required' => 'Supplier name is required',
            'supplier.max' => 'Supplier name cannot exceed 255 characters'
        ];
    }
}
