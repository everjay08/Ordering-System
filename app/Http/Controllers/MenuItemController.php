<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $menuItems = MenuItem::all();
        return response()->json($menuItems, 200);
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|integer|min:0',
            'is_available' => 'required|boolean',
        ]);

        $menuItem = MenuItem::create($validated);

        return response()->json($menuItem, 201);
    }

    // Display the specified resource
    public function show($id)
    {
        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return response()->json(['message' => 'Menu item not found'], 404);
        }

        return response()->json($menuItem, 200);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return response()->json(['message' => 'Menu item not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'sometimes|required|integer|min:0',
            'is_available' => 'sometimes|required|boolean',
        ]);

        $menuItem->update($validated);

        return response()->json($menuItem, 200);
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return response()->json(['message' => 'Menu item not found'], 200);
        }

        $menuItem->delete();

        return response()->json(['message' => 'Menu item deleted'], 200);
    }
}
