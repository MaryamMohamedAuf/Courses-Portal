<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;
use App\Models\Achievement;

class BadgeSeeder extends Seeder
{
    public function run()
    {
        $badges = [
            ['name' => 'Beginner', 'required_achievements' => 0],
            ['name' => 'Intermediate', 'required_achievements' => 4],
            ['name' => 'Advanced', 'required_achievements' => 8],
            ['name' => 'Master', 'required_achievements' => 10],
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }

        Achievement::factory()->count(4)->create();

    }
}
