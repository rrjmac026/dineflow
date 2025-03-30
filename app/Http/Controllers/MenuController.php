<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::latest()->get();
        return view('menu.index', compact('menu'));
    }

    public function create()
    {
        return view('menu.create');
    }

    public function store(StoreMenuRequest $request)
    {
        $imagePath = $request->file('image')->store('menu-images', 'public');
        
        $menu = Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'image' => $imagePath,
            'status' => $request->status ?? 'available'
        ]);

        return redirect()->route('menu.index')
            ->with('success', 'Menu item added successfully!');
    }

    public function show(Menu $menu)
    {
        return view('menu.show', compact('menu'));
    }

    public function edit(Menu $menu)
    {
        return view('menu.edit', compact('menu'));
    }

    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'status' => $request->status ?? $menu->status
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')->store('menu-images', 'public');
        }

        $menu->update($data);

        return redirect()->route('menu.index')
            ->with('success', 'Menu item updated successfully!');
    }

    public function destroy(Menu $menu)
    {
        try {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            
            $menu->delete();
            return redirect()->route('menu.index')
                ->with('success', 'Menu item deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('menu.index')
                ->with('error', 'Failed to delete menu item. It may be in use.');
        }
    }

    public function updateStatus(Request $request, Menu $menu)
    {
        $request->validate([
            'status' => ['required', 'in:available,unavailable']
        ]);

        $menu->update([
            'status' => $request->status
        ]);
        
        return back()->with('success', 'Menu status updated successfully!');
    }
}
