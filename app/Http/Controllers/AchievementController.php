<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    /**
     * Display a listing of the achievements.
     */
    public function index()
    {
        // Fetch all achievements
        $achievements = Achievement::all();
        
        return response()->json($achievements);
    }

    

    /**
     * Store a newly created achievement in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'threshold' => 'required|integer',
        ]);

        // Create the achievement
        $achievement = Achievement::create($request->all());

        return response()->json($achievement, 201);
    }

    
    /**
     * Update the specified achievement in storage.
     */
    public function update(Request $request, Achievement $achievement)
    {
        // Validate the request
        $request = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|string|max:50',
            'threshold' => 'sometimes|required|integer',
        ]);

        // Update the achievement
        $achievement->update($request);

        return response()->json($achievement);
    }

    /**
     * Remove the specified achievement from storage.
     */
    public function destroy(Achievement $achievement)
    {
        $achievement->delete();

        return response()->json(['message' => 'Achievement deleted successfully']);
    }
}
