<?php

namespace App\Providers;

use App\Services\AchievementAndBadgeService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AchievementAndBadgeService::class, function ($app) {
            return new AchievementAndBadgeService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
