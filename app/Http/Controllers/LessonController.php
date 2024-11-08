<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the lessons.
     */
    public function index()
    {
        $lessons = Lesson::all();  // Fetch all lessons

        return response()->json($lessons);  // Return lessons as JSON
    }

    /**
     * Show the form for creating a new lesson (not needed for API, so no implementation).
     */
    public function create()
    {
        return response()->json(['message' => 'Create method is not used in API.']);
    }

    /**
     * Store a newly created lesson in the database.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',  // Ensure the course_id exists in the courses table
        ]);

        // Create a new lesson
        $lesson = Lesson::create($validated);

        // Return a JSON response with the created lesson
        return response()->json([
            'message' => 'Lesson created successfully!',
            'lesson' => $lesson,
        ], 201);  // HTTP 201 Created
    }

    /**
     * Display the specified lesson.
     */
    public function show(Lesson $lesson)
    {
        return response()->json($lesson);  // Return the lesson as JSON
    }

    /**
     * Show the form for editing the specified lesson (not needed for API, so no implementation).
     */
    public function edit(Lesson $lesson)
    {
        return response()->json(['message' => 'Edit method is not used in API.']);
    }

    /**
     * Update the specified lesson in the database.
     */
    public function update(Request $request, Lesson $lesson)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',  // Ensure the course_id exists in the courses table
        ]);

        // Update the lesson
        $lesson->update($validated);

        // Return a JSON response with the updated lesson
        return response()->json([
            'message' => 'Lesson updated successfully!',
            'lesson' => $lesson,
        ]);
    }

    /**
     * Remove the specified lesson from storage.
     */
    public function destroy(Lesson $lesson)
    {
        // Delete the lesson
        $lesson->delete();

        // Return a success message as JSON
        return response()->json([
            'message' => 'Lesson deleted successfully!',
        ]);
    }
}
