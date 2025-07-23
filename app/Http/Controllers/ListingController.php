<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    // List all listings for the authenticated sitter
    public function index()
    {
        $listings = Listing::where('sitter_id', Auth::id())->get();
        return response()->json($listings);
    }

    // Store a new listing
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'service_type' => 'required|string|max:255',
        ]);
        $listing = Listing::create([
            'sitter_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'service_type' => $validated['service_type'],
        ]);
        return response()->json($listing, 201);
    }

    // Show a specific listing
    public function show(Listing $listing)
    {
        return response()->json($listing);
    }

    // Update a listing
    public function update(Request $request, Listing $listing)
    {
        $this->authorize('update', $listing);
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'service_type' => 'sometimes|required|string|max:255',
        ]);
        $listing->update($validated);
        return response()->json($listing);
    }

    // Delete a listing
    public function destroy(Listing $listing)
    {
        $this->authorize('delete', $listing);
        $listing->delete();
        return response()->json(['message' => 'Listing deleted']);
    }
} 