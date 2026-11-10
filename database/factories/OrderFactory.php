<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number'         => Order::generateOrderNumber(),
            'table_number'         => fake()->numberBetween(1, 20),
            'status'               => Order::getDefaultStatus(),
            'payment_status'       => Order::getDefaultPaymentStatus(),
            'total_price'          => fake()->randomFloat(2, 100, 2000),
            'special_instructions' => fake()->optional()->sentence(),
        ];
    }
}
