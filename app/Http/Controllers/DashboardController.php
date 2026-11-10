<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Inventory;
use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use Carbon\CarbonPeriod;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_customers'      => User::where('role', 'customer')->count(),
            'total_orders'         => Order::count(),
            'total_reservations'   => Reservation::count(),
            'total_menu_items'     => Menu::count(),
            'total_inventory'      => Inventory::count(),
            'pending_orders'       => Order::where('status', 'pending')->count(),
            'pending_reservations' => Reservation::where('status', 'pending')->count(),
            'low_stock_items'      => Inventory::whereRaw('quantity <= reorder_level')->count(),
        ];

        return view('dashboard', [
            'data'   => $data,
            'charts' => $this->chartData($data),
        ]);
    }

    private function chartData(array $data): array
    {
        // Orders per day, last 7 days (days with no orders are filled with 0)
        $start = now()->subDays(6)->startOfDay();
        $days  = collect(CarbonPeriod::create($start, now()->startOfDay()));

        $perDay = Order::where('created_at', '>=', $start)
            ->selectRaw('DATE(created_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->pluck('total', 'day');

        return [
            'ordersPerDay' => [
                'labels' => $days->map(fn ($d) => $d->format('M j'))->all(),
                'values' => $days->map(fn ($d) => (int) ($perDay[$d->toDateString()] ?? 0))->all(),
            ],
            'ordersByStatus'       => $this->countByStatus(Order::class),
            'reservationsByStatus' => $this->countByStatus(Reservation::class),
            'stockHealth' => [
                'In stock'  => max($data['total_inventory'] - $data['low_stock_items'], 0),
                'Low stock' => $data['low_stock_items'],
            ],
        ];
    }

    private function countByStatus(string $model): array
    {
        return $model::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->map(fn ($n) => (int) $n)
            ->all();
    }
}