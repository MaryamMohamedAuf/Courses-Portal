<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserAchievementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user/token', [RegisteredUserController::class, 'getUserIdAndToken']);

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});
route::get('/users/{user}/achievements', [UserAchievementController::class, 'index']);

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';
