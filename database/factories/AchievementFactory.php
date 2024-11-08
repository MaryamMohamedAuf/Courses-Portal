<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AchievementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $achievementData = [
            ['name' => 'First Lesson Watched', 'type' => 'lessons_watched', 'threshold' => 1],
            ['name' => '5 Lessons Watched', 'type' => 'lessons_watched', 'threshold' => 5],
            ['name' => '10 Lessons Watched', 'type' => 'lessons_watched', 'threshold' => 10],
            ['name' => '25 Lessons Watched', 'type' => 'lessons_watched', 'threshold' => 25],
            ['name' => '50 Lessons Watched', 'type' => 'lessons_watched', 'threshold' => 50],
            ['name' => 'First Comment Written', 'type' => 'comments_written', 'threshold' => 1],
            ['name' => '3 Comments Written', 'type' => 'comments_written', 'threshold' => 3],
            ['name' => '5 Comments Written', 'type' => 'comments_written', 'threshold' => 5],
            ['name' => '10 Comments Written', 'type' => 'comments_written', 'threshold' => 10],
            ['name' => '20 Comments Written', 'type' => 'comments_written', 'threshold' => 20],
        ];

        return [
            'name' => $achievementData[0]['name'],
            'type' => $achievementData[0]['type'],
            'threshold' => $achievementData[0]['threshold'],
        ];
    }
}
