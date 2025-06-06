<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Inventory;
use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_customers' => User::where('role', 'customer')->count(),
            'total_orders' => Order::count(),
            'total_reservations' => Reservation::count(),
            'total_menu_items' => Menu::count(),
            'total_inventory' => Inventory::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'pending_reservations' => Reservation::where('status', 'pending')->count(),
            'low_stock_items' => Inventory::whereRaw('quantity <= reorder_level')->count(),
        ];

        return view('dashboard', compact('data'));
    }
}
