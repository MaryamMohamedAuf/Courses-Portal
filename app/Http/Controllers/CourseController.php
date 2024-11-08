<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Services\AchievementAndBadgeService;
use Illuminate\Http\Request;

//apply dependency injection
class CourseController extends Controller
{
    public $AchievementAndBadgeService;

    public function __construct(AchievementAndBadgeService $AchievementAndBadgeService)
    {
        $this->AchievementAndBadgeService = $AchievementAndBadgeService;
    }

    public function registerUserForCourse(Request $request, $courseId, $userId)
    {
        $course = Course::findOrFail($courseId);
        $user = User::findOrFail($userId);
        // Enroll the user in the course
        $user->courses()->attach($course);
        // Enroll the user in all lessons of the course
        $lessons = $course->lessons; // Get all lessons related to the course
        foreach ($lessons as $lesson) {
            $user->lessons()->syncWithoutDetaching($lesson);  // Attach the lesson to the user if it is not already watched
        }
        $this->AchievementAndBadgeService->checkLessonAchievements($user);
        $this->AchievementAndBadgeService->checkBadge($user);

        return response()->json([
            'message' => 'User successfully enrolled in course and lessons.',
            'course' => $course,
            'lessons' => $lessons,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all(); // Retrieve all courses

        return response()->json($courses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'instructor_name' => 'required|string',
        ]);

        $course = Course::create($validated);

        return response()->json([
            'message' => 'Course successfully created.',
            'course' => $course,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'instructor_name' => 'required|string',
        ]);

        $course->update($validated);

        return response()->json([
            'message' => 'Course successfully updated.',
            'course' => $course,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return response()->json([
            'message' => 'Course successfully deleted.',
        ]);
    }
}
