<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SitterController extends Controller
{
    // Fetch sitters nearby a given location
    public function nearby(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'nullable|numeric',
        ]);
        $radius = $request->input('radius', 10); // default 10km
        $lat = $request->input('latitude');
        $lng = $request->input('longitude');

        // Simple Haversine formula for demonstration
        $sitters = User::where('user_type', User::TYPE_SITTER)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->selectRaw('*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance', [$lat, $lng, $lat])
            ->having('distance', '<=', $radius)
            ->orderBy('distance')
            ->get();

        return response()->json($sitters);
    }
} 