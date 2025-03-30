<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:menus,name'],
            'description' => ['required', 'string', 'max:1000'],
            'price' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Menu item name is required.',
            'name.unique' => 'This menu item name already exists.',
            'description.required' => 'Please provide a description.',
            'price.required' => 'Please set a price.',
            'price.min' => 'Price cannot be negative.',
            'category.required' => 'Please select a category.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'Image size cannot exceed 2MB.',
        ];
    }
}
