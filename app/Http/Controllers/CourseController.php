<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function registerUserForCourse(Request $request, $courseId)
    {
        $user = auth()->user();  // Get the authenticated user

        // Find the course
        $course = Course::findOrFail($courseId);

        // Enroll the user in the course
        $user->courses()->attach($course);

        // Enroll the user in all lessons of the course
        $lessons = $course->lessons; // Get all lessons related to the course
        foreach ($lessons as $lesson) {
            $user->lessons()->attach($lesson);  // Attach the lesson to the user
        }

        // Optionally return a response
        return response()->json([
            'message' => 'User successfully enrolled in course and lessons.',
            'course' => $course,
            'lessons' => $lessons
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
