<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'menu'])
            ->latest()
            ->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $menuItems = Menu::where('status', 'available')->get();
        return view('orders.create', compact('menuItems'));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create([
            'user_id' => $request->user_id,
            'menu_id' => $request->menu_id,
            'order_number' => Order::generateOrderNumber(),
            'table_number' => $request->table_number,
            'status' => $request->status,
            'payment_status' => $request->payment_status,
            'total_price' => $request->total_price,
            'special_instructions' => $request->special_instructions
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully!');
    }

    public function show(Order $order)
    {
        $order->load(['user', 'menu']);
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $menuItems = Menu::where('status', 'available')->get();
        return view('orders.edit', compact('order', 'menuItems'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update([
            'menu_id' => $request->menu_id,
            'table_number' => $request->table_number,
            'status' => $request->status,
            'payment_status' => $request->payment_status,
            'total_price' => $request->total_price,
            'special_instructions' => $request->special_instructions
        ]);

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully!');
    }

    public function destroy(Order $order)
    {
        try {
            $order->delete();
            return redirect()->route('orders.index')
                ->with('success', 'Order deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('orders.index')
                ->with('error', 'Failed to delete order.');
        }
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:pending,preparing,ready,completed,cancelled']
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Order status updated successfully!');
    }

    public function updatePayment(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => ['required', 'in:paid,unpaid,refunded']
        ]);

        $order->update([
            'payment_status' => $request->payment_status
        ]);

        return back()->with('success', 'Payment status updated successfully!');
    }
}
