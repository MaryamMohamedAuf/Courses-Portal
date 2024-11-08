<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    /**
     * Display a listing of the badges.
     */
    public function index()
    {
        // Fetch all badges with their related achievements
        $badges = Badge::all();
        
        return response()->json($badges);
    }

    

    /**
     * Store a newly created badge in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'required_achievements' => 'required|integer|min:1',
        ]);

        // Create the badge
        $badge = Badge::create($request->all());

        return response()->json($badge, 201);
    }

   
    /**
     * Update the specified badge in storage.
     */
    public function update(Request $request, Badge $badge)
    {
        // Validate the request
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'required_achievements' => 'sometimes|required|integer|min:1',
        ]);

        // Update the badge
        $badge->update($request->all());

        return response()->json($badge);
    }

    /**
     * Remove the specified badge from storage.
     */
    public function destroy(Badge $badge)
    {
        $badge->delete();

        return response()->json(['message' => 'Badge deleted successfully']);
    }
}
