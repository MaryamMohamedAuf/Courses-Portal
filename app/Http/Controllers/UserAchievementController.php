<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Badge;
use App\Models\User;

class UserAchievementController extends Controller
{
    public function index(User $user)
    {
        //pluck('name'): This method is used to extract only the name attribute from the achievements and returns them as a collection.
        $unlockedAchievements = $user->achievements->pluck('name')->toArray();
        $lessonsWatchedCount = $user->lessons()->count();
        $commentsCount = $user->comments()->count();

        // Fetch the highest unlocked lesson achievement threshold
        $highestLessonAchievement = Achievement::where('type', 'lessons_watched')
            ->whereIn('name', $unlockedAchievements)
            ->orderByDesc('threshold')
            ->first();

        // Fetch the highest unlocked comment achievement threshold
        $highestCommentAchievement = Achievement::where('type', 'comments_written')
            ->whereIn('name', $unlockedAchievements)
            ->orderByDesc('threshold')
            ->first();

        // Determine the next lesson achievement
        $nextLessonAchievement = Achievement::where('type', 'lessons_watched')
            ->where('threshold', '>', $highestLessonAchievement->threshold ?? 0)
            ->whereNotIn('name', $unlockedAchievements)
            ->orderBy('threshold')
            ->first();

        // Determine the next comment achievement
        $nextCommentAchievement = Achievement::where('type', 'comments_written')
            ->where('threshold', '>', $highestCommentAchievement->threshold ?? 0)
            ->whereNotIn('name', $unlockedAchievements)
            ->orderBy('threshold')
            ->first();

        // Collect names of next available achievements
        $nextAvailableAchievements = collect([$nextLessonAchievement, $nextCommentAchievement])
            ->filter() // Remove null values if no next achievement exists
            ->pluck('name')
            ->toArray();

        // Determine current badge
        //$currentBadge = $user->badge->name ?? 'Beginner';

        // Calculate next badge and remaining achievements required
        $achievementsCount = count($unlockedAchievements);
        $currentBadge = Badge::where('required_achievements', '<=', $achievementsCount)
            ->orderByDesc('required_achievements')  // Get the highest badge achieved
            ->first()->name ?? 'No badge';
        $nextBadge = Badge::where('required_achievements', '>', $achievementsCount)
            ->orderBy('required_achievements')
            ->first();

        $nextBadgeName = $nextBadge->name ?? 'No further badges';
        $remainingToNextBadge = $nextBadge ? $nextBadge->required_achievements - $achievementsCount : 0;

        return response()->json([
            'unlocked_achievements' => $unlockedAchievements,
            'next_available_achievements' => $nextAvailableAchievements,
            'current_badge' => $currentBadge,
            'next_badge' => $nextBadgeName,
            'remaining_to_unlock_next_badge' => $remainingToNextBadge,
        ]);
    }
}
