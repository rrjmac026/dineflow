<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::latest()->get();
        return view('inventory.index', compact('inventory'));
    }

    public function create()
    {
        return view('inventory.create');
    }

    public function store(StoreInventoryRequest $request)
    {
        $inventory = Inventory::create([
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'supplier' => $request->supplier,
            'unit_cost' => $request->unit_cost,
            'reorder_level' => $request->reorder_level ?? 10
        ]);

        return redirect()->route('inventory.index')
            ->with('success', 'Item added to inventory successfully!');
    }

    public function show(Inventory $inventory)
    {
        return view('inventory.show', compact('inventory'));
    }

    public function edit(Inventory $inventory)
    {
        return view('inventory.edit', compact('inventory'));
    }

    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        $inventory->update([
            'item_name' => $request->item_name,
            'quantity' => $request->quantity,
            'supplier' => $request->supplier,
            'unit_cost' => $request->unit_cost,
            'reorder_level' => $request->reorder_level ?? $inventory->reorder_level
        ]);

        return redirect()->route('inventory.index')
            ->with('success', 'Inventory item updated successfully!');
    }

    public function destroy(Inventory $inventory)
    {
        try {
            $inventory->delete();
            return redirect()->route('inventory.index')
                ->with('success', 'Inventory item deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('inventory.index')
                ->with('error', 'Failed to delete inventory item. It may be in use.');
        }
    }

    public function updateQuantity(Request $request, Inventory $inventory)
    {
        $request->validate([
            'adjustment' => ['required', 'integer'],
            'type' => ['required', 'in:add,subtract']
        ]);

        if ($request->type === 'subtract' && ($inventory->quantity - $request->adjustment) < 0) {
            return back()->with('error', 'Cannot reduce quantity below zero.');
        }

        $inventory->update([
            'quantity' => $request->type === 'add' 
                ? $inventory->quantity + $request->adjustment
                : $inventory->quantity - $request->adjustment
        ]);
        
        return back()->with('success', 'Quantity updated successfully!');
    }
}
