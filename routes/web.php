<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserAchievementController;
use Illuminate\Http\Request;

    Route::middleware('auth:web')->post('/courses/{courseId}/register', [CourseController::class, 'registerUserForCourse']);

    Route::middleware('auth')->get('/user', function (Request $request) {
        return $request->user();
    });
    
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

    route::get('/users/{user}/achievements', [UserAchievementController::class, 'index']);

require __DIR__.'/auth.php';
require __DIR__.'/api.php';

