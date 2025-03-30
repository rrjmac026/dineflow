<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'total_price' => ['required', 'numeric', 'min:0'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.menu_id' => ['required', 'exists:menus,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'special_instructions' => ['nullable', 'string', 'max:500']
        ];
    }

    public function messages(): array
    {
        return [
            'total_price.required' => 'Order total is required',
            'total_price.min' => 'Order total must be greater than zero',
            'items.required' => 'Order must contain at least one item',
            'items.min' => 'Order must contain at least one item',
            'items.*.menu_id.exists' => 'Selected menu item does not exist',
            'items.*.quantity.min' => 'Quantity must be at least 1',
            'special_instructions.max' => 'Special instructions cannot exceed 500 characters'
        ];
    }
}
