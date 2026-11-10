<?php

namespace Database\Seeders;

use App\Models\{User, Menu, Inventory, Order, Reservation, Feedback};
use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory()->count(5)->create();
        $menus = Menu::factory()->count(15)->create();

        Inventory::factory()->count(20)->create();

        foreach (range(1, 20) as $i) {
            Order::factory()->create([
                'user_id' => $users->random()->id,
                'menu_id' => $menus->random()->id,
            ]);
        }

        Reservation::factory()->count(10)->create([
            'user_id' => $users->random()->id,
        ]);

        Feedback::factory()->count(10)->create([
            'user_id' => $users->random()->id,
        ]);
    }

    
}