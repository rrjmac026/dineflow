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
        $orders = Order::with(['user', 'items.menu'])
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
            'user_id' => auth()->id(),
            'status' => 'pending',
            'total_price' => $request->total_price,
            'special_instructions' => $request->special_instructions,
            'payment_status' => 'unpaid',
            'table_number' => $request->table_number
        ]);

        // Store order items
        foreach ($request->items as $item) {
            $order->items()->create([
                'menu_id' => $item['menu_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'subtotal' => $item['quantity'] * $item['unit_price']
            ]);
        }

        return redirect()->route('orders.index')
            ->with('success', 'Order placed successfully!');
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.menu']);
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
            'status' => $request->status,
            'total_price' => $request->total_price,
            'special_instructions' => $request->special_instructions,
            'payment_status' => $request->payment_status,
            'table_number' => $request->table_number
        ]);

        // Update order items
        $order->items()->delete(); // Remove existing items
        foreach ($request->items as $item) {
            $order->items()->create([
                'menu_id' => $item['menu_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'subtotal' => $item['quantity'] * $item['unit_price']
            ]);
        }

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully!');
    }

    public function destroy(Order $order)
    {
        try {
            $order->items()->delete();
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
