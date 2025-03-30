<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menuItems = Menu::orderBy('category')->get();
        return view('menu.index', compact('menuItems'));
    }

    public function store(StoreMenuRequest $request)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu', 'public');
        }

        Menu::create(array_merge(
            $request->validated(),
            ['image' => $imagePath ?? null]
        ));

        return redirect()->route('menu.index')->with('success', 'Menu item created successfully');
    }

    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu', 'public');
            $menu->image = $imagePath;
        }

        $menu->update($request->validated());
        
        return redirect()->route('menu.index')->with('success', 'Menu item updated successfully');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu item deleted successfully');
    }
}
