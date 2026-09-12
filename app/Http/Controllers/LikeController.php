<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Blog $blog)
    {
        $like = $request->user()->likes()->firstOrCreate([
            'blog_id' => $blog->id,
        ]);

        return response()->json([
            'message' => 'Blog liked successfully.',
            'likes_count' => $blog->likes()->count(),
        ]);
    }

    public function destroy(Request $request, Blog $blog)
    {
        $request->user()
            ->likes()
            ->where('blog_id', $blog->id)
            ->delete();

        return response()->json([
            'message' => 'Blog unliked successfully.',
            'likes_count' => $blog->likes()->count(),
        ]);
    }
}