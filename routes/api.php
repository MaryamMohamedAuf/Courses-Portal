<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserAchievementController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::prefix('api')->middleware('auth:sanctum')->group(function () {
        Route::post('/courses/{courseId}/register', [CourseController::class, 'registerUserForCourse']);
        route::get('/users/{user}/achievements', [UserAchievementController::class, 'index']);
    });

