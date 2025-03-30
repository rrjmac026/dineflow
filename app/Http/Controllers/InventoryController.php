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

    public function store(StoreInventoryRequest $request)
    {
        Inventory::create($request->validated());
        return redirect()->back()->with('success', 'Item added to inventory successfully!');
    }

    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        $inventory->update($request->validated());
        return redirect()->back()->with('success', 'Inventory item updated successfully!');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->back()->with('success', 'Inventory item deleted successfully!');
    }
}
