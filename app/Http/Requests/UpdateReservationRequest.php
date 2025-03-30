<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UpdateReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => ['sometimes', 'required', 'date', 'after_or_equal:today'],
            'time' => ['sometimes', 'required', 'date_format:H:i', 'after_or_equal:10:00', 'before:22:00'],
            'guests' => ['sometimes', 'required', 'integer', 'min:1', 'max:20']
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => 'Please select a date',
            'date.after_or_equal' => 'Reservation date must be today or a future date',
            'time.required' => 'Please select a time',
            'time.date_format' => 'Invalid time format',
            'time.after_or_equal' => 'Restaurant opens at 10:00 AM',
            'time.before' => 'Restaurant closes at 10:00 PM',
            'guests.required' => 'Please specify number of guests',
            'guests.min' => 'Minimum of 1 guest required',
            'guests.max' => 'Maximum of 20 guests allowed'
        ];
    }
}
