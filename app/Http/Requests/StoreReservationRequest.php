<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => ['required', 'date_format:H:i', 'after_or_equal:10:00', 'before:22:00'],
            'guests' => ['required', 'integer', 'min:1', 'max:20'],
            'contact_number' => ['required', 'string', 'regex:/^[0-9]{11}$/'],
            'special_requests' => ['nullable', 'string', 'max:500']
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
            'guests.max' => 'Maximum of 20 guests allowed',
            'contact_number.required' => 'Please provide a contact number',
            'contact_number.regex' => 'Contact number must be 11 digits',
            'special_requests.max' => 'Special requests cannot exceed 500 characters'
        ];
    }
}
