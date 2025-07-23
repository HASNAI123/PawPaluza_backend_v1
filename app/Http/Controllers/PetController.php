<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    // List all pets for the authenticated user
    public function index()
    {
        return response()->json(Auth::user()->pets);
    }

    // Store a new pet for the authenticated user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);
        $pet = Auth::user()->pets()->create($validated);
        return response()->json($pet, 201);
    }

    // Show a specific pet
    public function show(Pet $pet)
    {
        $this->authorize('view', $pet);
        return response()->json($pet);
    }

    // Update a pet
    public function update(Request $request, Pet $pet)
    {
        $this->authorize('update', $pet);
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);
        $pet->update($validated);
        return response()->json($pet);
    }

    // Delete a pet
    public function destroy(Pet $pet)
    {
        $this->authorize('delete', $pet);
        $pet->delete();
        return response()->json(['message' => 'Pet deleted']);
    }
} 