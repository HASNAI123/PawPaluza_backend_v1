<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // List bookings for the authenticated user (owner or sitter)
    public function index()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)
            ->orWhere('sitter_id', $user->id)
            ->get();
        return response()->json($bookings);
    }

    // Create a new booking (owner)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sitter_id' => 'required|exists:users,id',
            'pet_id' => 'required|exists:pets,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'sitter_id' => $validated['sitter_id'],
            'pet_id' => $validated['pet_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => 'pending',
        ]);
        return response()->json($booking, 201);
    }

    // Show a specific booking
    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return response()->json($booking);
    }

    // Update a booking (owner or sitter)
    public function update(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);
        $validated = $request->validate([
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
            'status' => 'sometimes|string',
        ]);
        $booking->update($validated);
        return response()->json($booking);
    }

    // Cancel a booking (owner or sitter)
    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);
        $booking->delete();
        return response()->json(['message' => 'Booking cancelled']);
    }
} 