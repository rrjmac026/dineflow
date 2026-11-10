<?php

namespace Database\Factories;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_name'     => fake()->unique()->words(2, true),
            'quantity'      => fake()->numberBetween(0, 200),
            'supplier'      => fake()->company(),
            'unit_cost'     => fake()->randomFloat(2, 5, 500),
            'reorder_level' => fake()->numberBetween(5, 30),
        ];
    }
}
