<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Fetch all orders
    public function index()
    {
        $orders = Order::with(['customer', 'delivery', 'menuItems'])->get();
        return response()->json($orders, 200);
    }

    // Create a new order
    public function store(Request $request)
    {
        $validated = $request->validate([
            'total_amount' => 'required|integer|min:0',
            'customer_id' => 'nullable|exists:users,id',
            'delivery_id' => 'nullable|exists:users,id',
            'status' => 'required|in:Pending,Processing,Delivered,Cancelled',
            'delivery_address' => 'required|string|max:255',
            'menu_items' => 'required|array',
            'menu_items.*' => 'exists:menu_items,id',
        ]);

        // Create order
        $order = Order::create([
            'total_amount' => $validated['total_amount'],
            'customer_id' => $validated['customer_id'],
            'delivery_id' => $validated['delivery_id'],
            'status' => $validated['status'],
            'delivery_address' => $validated['delivery_address'],
        ]);
    

        // Attach menu items
        $order->menuItems()->attach($validated['menu_items']);

        return response()->json($order->load(['customer', 'delivery', 'menuItems']), 201);
    }

    // Fetch a specific order
    public function show($id)
    {
        $order = Order::with(['customer', 'delivery', 'menuItems'])->find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 200);
        }

        return response()->json($order, 200);
    }

    // Update an order
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 200);
        }

        $validated = $request->validate([
            'total_amount' => 'sometimes|integer|min:0',
            'customer_id' => 'nullable|exists:users,id',
            'delivery_id' => 'nullable|exists:users,id',
            'status' => 'sometimes|in:Pending,Processing,Delivered,Cancelled',
            'delivery_address' => 'sometimes|string|max:255',
            'menu_items' => 'sometimes|array',
            'menu_items.*' => 'exists:menu_items,id',
        ]);

        // Update order details
        $order->update($validated);

        // Update menu items if provided
        if (isset($validated['menu_items'])) {
            $order->menuItems()->sync($validated['menu_items']);
        }

        return response()->json($order->load(['customer', 'delivery', 'menuItems']), 200);
    }

    // Delete an order
    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 200);
        }

        $order->menuItems()->detach();
        $order->delete();

        return response()->json(['message' => 'Order deleted'], 200);
    }
}
