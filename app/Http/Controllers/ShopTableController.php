<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopTable;
use Illuminate\Http\Request;

class ShopTableController extends Controller
{
    // Fetch all tables
    public function index()
    {
        $tables = ShopTable::all();
        return response()->json($tables, 200);
    }

    // Fetch available tables only
    public function available()
    {
        $tables = ShopTable::available()->get();
        return response()->json($tables, 200);
    }

    // Create a new table
    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_number' => 'required|string|unique:shop_tables,table_number',
            'capacity' => 'required|integer|min:1',
            'is_available' => 'sometimes|boolean',
        ]);

        $table = ShopTable::create($validated);
        return response()->json($table, 201);
    }

    // Fetch a specific table
    public function show($id)
    {
        $table = ShopTable::find($id);

        if (!$table) {
            return response()->json(['message' => 'Table not found'], 200);
        }

        return response()->json($table, 200);
    }

    // Update a table
    public function update(Request $request, $id)
    {
        $table = ShopTable::find($id);

        if (!$table) {
            return response()->json(['message' => 'Table not found'], 200);
        }

        $validated = $request->validate([
            'table_number' => "sometimes|string|unique:shop_tables,table_number,{$id}",
            'capacity' => 'sometimes|integer|min:1',
            'is_available' => 'sometimes|boolean',
        ]);

        $table->update($validated);
        return response()->json($table, 200);
    }

    // Delete a table
    public function destroy($id)
    {
        $table = ShopTable::find($id);

        if (!$table) {
            return response()->json(['message' => 'Table not found'], 200);
        }

        $table->delete();
        return response()->json(['message' => 'Table deleted'], 204);
    }
}
