<?php

namespace App\Http\Controllers;

use App\Models\OrderMenuItem;
use Illuminate\Http\Request;

class OrderMenuItemController extends Controller
{
    /**
     * Display a listing of the order menu items.
     */
    public function index()
    {
        $orderMenuItems = OrderMenuItem::all();
        return response()->json($orderMenuItems);
    }

    /**
     * Store a newly created order menu item in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'menu_item_id' => 'required|exists:menu_items,id',
        ]);

        $orderMenuItem = OrderMenuItem::create($validated);

        return response()->json($orderMenuItem, 201); // Created status
    }

    /**
     * Display the specified order menu item.
     */
    public function show($id)
    {
        $orderMenuItem = OrderMenuItem::find($id);

        if (!$orderMenuItem) {
            return response()->json(['message' => 'OrderMenuItem not found'], 200);
        }

        return response()->json($orderMenuItem);
    }

    /**
     * Update the specified order menu item in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'menu_item_id' => 'required|exists:menu_items,id',
        ]);

        $orderMenuItem = OrderMenuItem::find($id);

        if (!$orderMenuItem) {
            return response()->json(['message' => 'OrderMenuItem not found'], status: 200);
        }

        $orderMenuItem->update($validated);

        return response()->json($orderMenuItem);
    }

    /**
     * Remove the specified order menu item from storage.
     */
    public function destroy($id)
    {
        $orderMenuItem = OrderMenuItem::find($id);

        if (!$orderMenuItem) {
            return response()->json(['message' => 'OrderMenuItem not found'], 200);
        }

        $orderMenuItem->delete();

        return response()->json(['message' => 'OrderMenuItem deleted successfully']);
    }
}
