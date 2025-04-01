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
            'name' => 'Jam',
            'email' => 'jam@jam.com',
            'password' => bcrypt('password'), // password
            'role' => 'customer', // Assuming you have a role column
        ]);

        User::factory()->create([
            'name' => 'Rey Rameses Jude S Macalutas',
            'email' => '1901102366@student.buksu.edu.ph',
            'password' => bcrypt('password'), // password
            'role' => 'Manager', // Assuming you have a role column
        ]);
    }
}

