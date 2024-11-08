<?php

namespace Tests\Feature;

use App\Models\Achievement;
use App\Models\Badge;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Tests\TestCase; // Import Log facade

class UserAchievementControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Set up test data for achievements and badges
        Achievement::create([
            'name' => 'First Lesson Achieved',
            'type' => 'lessons_watched',
            'threshold' => 1,
        ]);
        Achievement::create([
            'name' => '5 Lessons Achieved',
            'type' => 'lessons_watched',
            'threshold' => 5,
        ]);
        Achievement::create([
            'name' => 'First Comment Achieved',
            'type' => 'comments_written',
            'threshold' => 1,
        ]);
        Achievement::create([
            'name' => '3 Comments Achieved',
            'type' => 'comments_written',
            'threshold' => 3,
        ]);
        Badge::create([
            'name' => 'Beginner',
            'required_achievements' => 0,
        ]);
        Badge::create([
            'name' => 'Intermediate',
            'required_achievements' => 4,
        ]);
    }

    /** @test */
    public function it_returns_user_achievements_and_badges()
    {
        // Create a user with some unlocked achievements
        $user = User::factory()->create();
        $user->achievements()->attach(Achievement::where('name', 'First Lesson Achieved')->first());
        $user->achievements()->attach(Achievement::where('name', 'First Comment Achieved')->first());

        // Assign badge to user
        $user->badges()->attach(Badge::where('name', 'Beginner')->first());
        $user->save();

        // Log the user details for debugging
        Log::info('Created user:', ['user_id' => $user->id, 'achievements' => $user->achievements->pluck('name')->toArray()]);

        // Call the API endpoint
        $response = $this->getJson("/users/{$user->id}/achievements");

        // Log the response for debugging
        Log::info('API Response:', ['response' => $response->json()]);

        // Assert the response structure and values
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'unlocked_achievements' => [
                    'First Lesson Achieved',
                    'First Comment Achieved',
                ],
                'next_available_achievements' => [
                    '5 Lessons Achieved',
                    '3 Comments Achieved',
                ],
                'current_badge' => 'Beginner',
                'next_badge' => 'Intermediate',
                'remaining_to_unlock_next_badge' => 2,  // 2 more achievements needed to unlock Intermediate
            ]);
    }

    /** @test */
    /** @test */
    public function it_handles_no_achievements_unlocked_for_user()
    {
        // Create a user with no unlocked achievements
        $user = User::factory()->create();

        // Assign badge to user
        $user->badges()->attach(Badge::where('name', 'Beginner')->first());
        $user->save();

        // Log the user details for debugging
        Log::info('Created user with no achievements:', ['user_id' => $user->id]);

        // Call the API endpoint
        $response = $this->getJson("/users/{$user->id}/achievements");

        // Log the response for debugging
        Log::info('API Response:', ['response' => $response->json()]);

        // Assert the response structure and values
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'unlocked_achievements' => [],
                'next_available_achievements' => [
                    'First Lesson Achieved',
                    'First Comment Achieved',
                ],
                'current_badge' => 'Beginner',
                'next_badge' => 'Intermediate',
                'remaining_to_unlock_next_badge' => 4,  // 4 more achievements needed to unlock Intermediate
            ]);
    }
}
