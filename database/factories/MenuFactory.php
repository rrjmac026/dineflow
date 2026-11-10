<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends Factory<Menu>
 */
class MenuFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => fake()->words(2, true),
            'description' => fake()->sentence(),
            'price'       => fake()->randomFloat(2, 50, 500),
            'category'    => fake()->randomElement(['Appetizer', 'Main', 'Dessert', 'Drink']),
            'status'      => 'available',
            'image'       => $this->randomImage(),
        ];
    }

    private function randomImage(): ?string
    {
        try {
            $response = Http::timeout(15)->get('https://picsum.photos/640/480');

            if (! $response->successful()) {
                return null;
            }

            $path = 'menus/' . Str::uuid() . '.jpg';
            Storage::disk('public')->put($path, $response->body());

            return $path;
        } catch (\Throwable $e) {
            return null; // no internet / Picsum down, seed continues without image
        }
    }
}