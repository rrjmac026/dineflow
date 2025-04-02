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
        
        try {

            \Log::info('Order request received:', $request->all());
            // Validate the request
            $request->validate([
                'menu_id' => 'required|exists:menus,id',
                'special_instructions' => 'nullable|string|max:500'
            ]);

            // Get the menu item
            $menu = Menu::findOrFail($request->menu_id);
            
            // Get next available table number
            $occupiedTables = Order::whereIn('status', ['pending', 'preparing'])
                                 ->pluck('table_number')
                                 ->toArray();
            
            $availableTables = array_diff(range(1, 20), $occupiedTables);
            
            if (empty($availableTables)) {
                return back()->with('error', 'Sorry, all tables are currently occupied. Please try again later.');
            }

            $tableNumber = min($availableTables);

            // Create the order
            $order = Order::create([
                'user_id' => auth()->id(),
                'menu_id' => $menu->id,
                'order_number' => Order::generateOrderNumber(),
                'table_number' => $tableNumber,
                'status' => Order::getDefaultStatus(),
                'payment_status' => Order::getDefaultPaymentStatus(),
                'total_price' => $menu->price,
                'special_instructions' => $request->special_instructions
            ]);

            // Redirect with success message
            return redirect()->route('customer.orders')
                ->with('success', "Order placed successfully! Your table number is #{$tableNumber}");

        } catch (\Exception $e) {
            \Log::error('Order placement failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function cancelOrder(Order $order)
    {
        // Verify the order belongs to the authenticated user
        if ($order->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        // Only allow cancellation of pending or preparing orders
        if (!in_array($order->status, ['pending', 'preparing'])) {
            return back()->with('error', 'This order cannot be cancelled.');
        }

        $order->delete();

        return back()->with('success', 'Order cancelled successfully.');
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
