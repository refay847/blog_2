<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        $comment = $blog->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $validated['body'],
        ]);

        $comment->load('user:id,name');

        return response()->json([
            'message' => 'Comment added successfully.',
            'comment' => $comment,
        ], 201);
    }

    public function update(
        Request $request,
        Blog $blog,
        $comment
    ) {
        $comment = $blog->comments()
            ->where('id', $comment)
            ->firstOrFail();

        if ($comment->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'You can only edit your own comments.',
            ], 403);
        }

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        $comment->update([
            'body' => $validated['body'],
        ]);

        $comment->load('user:id,name');

        return response()->json([
            'message' => 'Comment updated successfully.',
            'comment' => $comment,
        ]);
    }

    public function destroy(
        Request $request,
        Blog $blog,
        $comment
    ) {
        $comment = $blog->comments()
            ->where('id', $comment)
            ->firstOrFail();

        if ($comment->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'You can only delete your own comments.',
            ], 403);
        }

        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully.',
        ]);
    }
}