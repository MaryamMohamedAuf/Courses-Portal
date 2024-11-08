<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Services\AchievementAndBadgeService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $AchievementAndBadgeService;

    public function __construct(AchievementAndBadgeService $AchievementAndBadgeService)
    {
        $this->AchievementAndBadgeService = $AchievementAndBadgeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($user_id)
    {
        $comments = Comment::where('user_id', $user_id)->get();

        return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $user_id)
    {
        $request->validate([
            'content' => 'required|string|min:3|max:1000',
        ]);
        $user = User::findOrFail($user_id);

        $comment = Comment::create([
            'user_id' => $user_id,
            'content' => $request->content,
        ]);
        $this->AchievementAndBadgeService->checkCommentAchievements($user);
        $this->AchievementAndBadgeService->checkBadge($user);

        // Return response with the created comment
        return response()->json([
            'message' => 'Comment successfully added.',
            'comment' => $comment,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
