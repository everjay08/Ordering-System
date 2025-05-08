<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TableReservation;
use App\Models\ShopTable;
use Illuminate\Http\Request;

class TableReservationController extends Controller
{
    // Fetch all reservations
    public function index()
    {
        $reservations = TableReservation::with(['customer', 'table'])->get();
        return response()->json($reservations, 200);
    }

    // Create a new reservation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'table_id' => 'required|exists:shop_tables,id',
            'reservation_date' => 'required|date_format:Y-m-d H:i:s|after:now',
            'status' => 'required|in:Pending,Confirmed,Cancelled,Done',
        ]);

        // Check table availability
        $table = ShopTable::findOrFail($validated['table_id']);
        if (!$table->is_available) {
            return response()->json(['message' => 'Table is not available'], 200);
        }

        // Create reservation
        $reservation = TableReservation::create($validated);

        // Mark table as unavailable
        $table->update(['is_available' => false]);

        return response()->json($reservation->load(['customer', 'table']), 201);
    }

    // Fetch a specific reservation
    public function show($id)
    {
        $reservation = TableReservation::with(['customer', 'table'])->find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 200);
        }

        return response()->json($reservation, 200);
    }

    // Update a reservation
    public function update(Request $request, $id)
    {
        $reservation = TableReservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 200);
        }

        $validated = $request->validate([
            'customer_id' => 'sometimes|exists:users,id',
            'table_id' => 'sometimes|exists:shop_tables,id',
            'reservation_date' => 'sometimes|date_format:Y-m-d H:i:s|after:now',
            'status' => 'sometimes|in:Pending,Confirmed,Cancelled,Done',
        ]);

        // If changing the table, check its availability
        if (isset($validated['table_id'])) {
            $newTable = ShopTable::findOrFail($validated['table_id']);
            if (!$newTable->is_available) {
                return response()->json(['message' => 'New table is not available'], 200);
            }
            // Update old table status
            $reservation->table->update(['is_available' => true]);
            $newTable->update(['is_available' => false]);
        }

        $reservation->update($validated);

        return response()->json($reservation->load(['customer', 'table']), 200);
    }

    // Delete a reservation
    public function destroy($id)
    {
        $reservation = TableReservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 200);
        }

        // Mark table as available
        $reservation->table->update(['is_available' => true]);

        $reservation->delete();

        return response()->json(['message' => 'Reservation deleted'], 204);
    }
}
