<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends Factory<Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'          => User::factory(),
            'date'             => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'time'             => fake()->time('H:i'),
            'guests'           => fake()->numberBetween(1, 10),
            'contact_number'   => fake()->numerify('09#########'),
            'special_requests' => fake()->optional()->sentence(),
            'status'           => fake()->randomElement(['pending', 'confirmed', 'cancelled']),
            'table_number'     => fake()->numberBetween(1, 20),
        ];
    }
}
