<?php

namespace Database\Factories;

use App\Models\Achievement;
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
        // You can generate achievements dynamically here
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

        // Randomly select one of the predefined achievements
        $achievement = $this->faker->randomElement($achievementData);

        return [
            'name' => $achievement['name'],
            'type' => $achievement['type'],
            'threshold' => $achievement['threshold'],
        ];
    }
}
