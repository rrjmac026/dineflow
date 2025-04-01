<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Feedback;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $menuItems = Menu::where('status', 'available')
            ->orderBy('category')
            ->get();
            
        $orders = auth()->user()->orders()
            ->with('menu')
            ->latest()
            ->take(5)
            ->get();

        return view('customer.dashboard', compact('menuItems', 'orders'));
    }

    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'table_number' => 'required|integer|min:1',
            'special_instructions' => 'nullable|string|max:500'
        ]);

        $menu = Menu::findOrFail($request->menu_id);

        $order = Order::create([
            'user_id' => auth()->id(),
            'menu_id' => $menu->id,
            'order_number' => Order::generateOrderNumber(),
            'table_number' => $request->table_number,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'total_price' => $menu->price,
            'special_instructions' => $request->special_instructions
        ]);

        return back()->with('success', 'Order placed successfully!');
    }

    public function submitFeedback(Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string|max:500'
        ]);

        Feedback::create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'message' => $request->message
        ]);

        return back()->with('success', 'Thank you for your feedback!');
    }

    public function menu()
    {
        $menuItems = Menu::where('status', 'available')
            ->orderBy('category')
            ->get();
            
        return view('customer.menu', compact('menuItems'));
    }

    public function orders()
    {
        $orders = auth()->user()->orders()
            ->with('menu')
            ->latest()
            ->paginate(10);
            
        return view('customer.orders', compact('orders'));
    }

    public function feedback()
    {
        $feedbacks = auth()->user()->feedbacks()
            ->latest()
            ->get();
            
        return view('customer.feedback', compact('feedbacks'));
    }
}
