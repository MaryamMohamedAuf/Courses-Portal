<?php

namespace App\Services;

use App\Models\Achievement;
use App\Models\Badge;
use App\Models\User;
use App\Notifications\AchievementUnlocked;
use App\Notifications\BadgeUnlocked;
use Illuminate\Support\Facades\Notification;

class AchievementAndBadgeService
{
    public function checkLessonAchievements(User $user)
    {
        $lessonsWatchedCount = $user->lessons()->count();

        // Example: Fetch lesson achievements with thresholds met by the user
        $achievements = Achievement::where('type', 'lessons_watched')
            ->where('threshold', '<=', $lessonsWatchedCount)
            ->get();

        foreach ($achievements as $achievement) {
            if (! $user->achievements->contains($achievement->id)) {
                $user->achievements()->attach($achievement);
                Notification::send($user, new AchievementUnlocked($achievement));

            }
        }
    }

    public function checkCommentAchievements(User $user)
    {
        $commentsCount = $user->comments()->count();

        // Similar logic for comments
        $achievements = Achievement::where('type', 'comments_written')
            ->where('threshold', '<=', $commentsCount)
            ->get();

        foreach ($achievements as $achievement) {
            if (! $user->achievements->contains($achievement->id)) {
                $user->achievements()->attach($achievement);
            }
        }
    }

    public function checkBadge(User $user)
    {
        $achievementsCount = $user->achievements()->count();

        $nextBadge = Badge::where('required_achievements', '<=', $achievementsCount)->orderByDesc('required_achievements')->first();

        if ($nextBadge && $user->badges() !== $nextBadge->id) {
            $user->badges()->attach($nextBadge->id);
            $user->save();
            Notification::send($user, new BadgeUnlocked($nextBadge));
        }
    }
}
