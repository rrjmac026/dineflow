<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message' => ['required', 'string', 'min:10', 'max:1000'],
            'rating' => ['required', 'integer', 'between:1,5']
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' => 'Please provide your feedback message.',
            'message.min' => 'Feedback message must be at least 10 characters.',
            'message.max' => 'Feedback message cannot exceed 1000 characters.',
            'rating.required' => 'Please provide a rating.',
            'rating.between' => 'Rating must be between 1 and 5.',
        ];
    }
}
