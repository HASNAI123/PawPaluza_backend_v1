<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // List reviews for a sitter
    public function index(Request $request)
    {
        $sitterId = $request->query('sitter_id');
        $reviews = Review::where('sitter_id', $sitterId)->get();
        return response()->json($reviews);
    }

    // Add a review (owner)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'sitter_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);
        $review = Review::create([
            'booking_id' => $validated['booking_id'],
            'reviewer_id' => Auth::id(),
            'sitter_id' => $validated['sitter_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);
        return response()->json($review, 201);
    }
} 