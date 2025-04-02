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
            'user_id' => ['required', 'exists:users,id'],
            'menu_id' => ['required', 'exists:menus,id'],
            'order_number' => ['required', 'string', 'unique:orders,order_number'],
            'table_number' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:pending,preparing,ready,completed,cancelled'],
            'payment_status' => ['required', 'in:paid,unpaid,refunded'],
            'total_price' => ['required', 'numeric', 'min:0'],
            'special_instructions' => ['nullable', 'string', 'max:500']
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Please select a customer',
            'menu_id.required' => 'Please select a menu item',
            'table_number.required' => 'Table number is required',
            'total_price.min' => 'Total price must be greater than zero'
        ];
    }
}
