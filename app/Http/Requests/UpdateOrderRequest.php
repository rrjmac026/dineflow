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
            'status' => ['required', Rule::in(['pending', 'preparing', 'completed', 'cancelled'])],
            'total_price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'special_instructions' => ['nullable', 'string', 'max:500']
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Order status is required',
            'status.in' => 'Invalid order status',
            'total_price.min' => 'Order total must be greater than zero',
            'special_instructions.max' => 'Special instructions cannot exceed 500 characters'
        ];
    }
}
