<?php

namespace Database\Factories;

use App\Models\Badge;
use Illuminate\Database\Eloquent\Factories\Factory;

class BadgeFactory extends Factory
{
    protected $model = Badge::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Beginner', 'Intermediate', 'Advanced', 'Master']),
            'required_achievements' => $this->faker->randomElement([0, 4, 8, 10]),
        ];
    }
}
