<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailabilityController extends Controller
{
    // List all availabilities for the authenticated sitter
    public function index()
    {
        $availabilities = Availability::where('sitter_id', Auth::id())->get();
        return response()->json($availabilities);
    }

    // Store new availability
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $availability = Availability::create([
            'sitter_id' => Auth::id(),
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);
        return response()->json($availability, 201);
    }

    // Update availability
    public function update(Request $request, Availability $availability)
    {
        $this->authorize('update', $availability);
        $validated = $request->validate([
            'date' => 'sometimes|date',
            'start_time' => 'sometimes',
            'end_time' => 'sometimes',
        ]);
        $availability->update($validated);
        return response()->json($availability);
    }

    // Delete availability
    public function destroy(Availability $availability)
    {
        $this->authorize('delete', $availability);
        $availability->delete();
        return response()->json(['message' => 'Availability deleted']);
    }
} 