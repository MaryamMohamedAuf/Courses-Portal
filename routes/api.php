<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserAchievementController;

Route::get('users/{user}/achievements', [UserAchievementController::class, 'index']);

?>