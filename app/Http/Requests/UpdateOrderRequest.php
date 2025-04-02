<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'menu_id' => ['required', 'exists:menus,id'],
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
            'menu_id.required' => 'Please select a menu item',
            'table_number.required' => 'Table number is required',
            'total_price.min' => 'Total price must be greater than zero'
        ];
    }
}
