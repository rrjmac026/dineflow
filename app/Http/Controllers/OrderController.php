<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'total_price' => $request->total_price
        ]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed successfully!');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        return redirect()->back()->with('success', 'Order updated successfully!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order cancelled successfully');
    }
}
