<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;

class AchievementSeeder extends Seeder
{
    public function run()
    {
        // Use the factory to create predefined achievements
        Achievement::factory()->count(10)->create();
    }
}
