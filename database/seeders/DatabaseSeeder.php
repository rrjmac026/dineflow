<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create the users with specified roles
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // password
            'role' => 'admin', // Assuming you have a role column
        ]);

        User::factory()->create([
            'name' => 'Customer 1',
            'email' => 'customer@customer.com',
            'password' => bcrypt('password'), // password
            'role' => 'customer', // Assuming you have a role column
        ]);

        User::factory()->create([
            'name' => 'Customer 2',
            'email' => 'customer2@customer.com',
            'password' => bcrypt('password'), // password
            'role' => 'customer', // Assuming you have a role column
        ]);

    }
}

