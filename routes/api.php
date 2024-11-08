<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserAchievementController;
use Illuminate\Support\Facades\Route;

Route::resource('courses', CourseController::class);
Route::resource('lessons', LessonController::class);
Route::resource('acheivements', AchievementController::class);
Route::resource('badges', BadgeController::class);

// Route::middleware('auth:sanctum')->group(function () {
Route::post('/courses/{course_id}/{user_id}', [CourseController::class, 'registerUserForCourse']);
route::get('/users/{user}/achievements', [UserAchievementController::class, 'index']);
Route::post('/{id}/comment', [CommentController::class, 'store']);

// });
