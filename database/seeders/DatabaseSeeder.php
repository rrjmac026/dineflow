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
      
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@example.com',
            'password' => bcrypt('password'),
            'role' => 'manager',
        ]);

        User::factory()->create([
            'name' => 'Customer 1',
            'email' => 'customer@customer.com',
            'password' => bcrypt('password'), 
            'role' => 'customer', 
        ]);

        User::factory()->create([
            'name' => 'Customer 2',
            'email' => 'customer2@customer.com',
            'password' => bcrypt('password'), 
            'role' => 'customer',
        ]);

    }
}

