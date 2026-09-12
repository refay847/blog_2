<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::with([
                'user:id,name',
                'comments.user:id,name',
            ])
            ->withCount([
                'likes',
                'comments',
            ])
            ->latest()
            ->get();

        // Add whether the currently authenticated user liked each blog.
        foreach ($blogs as $blog) {
            $blog->is_liked = $blog->likes()
                ->where('user_id', $request->user()->id)
                ->exists();
        }

        return response()->json([
            'blogs' => $blogs,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'img' => ['nullable', 'image', 'max:5120'],
        ]);

        $imagePath = null;

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('blogs', 'public');
        }

        $blog = Blog::create([
            'user_id' => $request->user()->id,
            'name' => $validated['name'],
            'description' => $validated['description'],
            'img' => $imagePath,
        ]);

        $blog->load([
            'user:id,name',
            'comments.user:id,name',
        ]);

        $blog->loadCount([
            'likes',
            'comments',
        ]);

        $blog->is_liked = false;

        return response()->json([
            'message' => 'Blog created successfully',
            'blog' => $blog,
        ], 201);
    }

    public function show(Request $request, Blog $blog)
    {
        $blog->load([
            'user:id,name',
            'comments.user:id,name',
        ]);

        $blog->loadCount([
            'likes',
            'comments',
        ]);

        $blog->is_liked = $blog->likes()
            ->where('user_id', $request->user()->id)
            ->exists();

        return response()->json([
            'blog' => $blog,
        ]);
    }

    public function update(Request $request, Blog $blog)
    {
        abort_unless(
            $blog->user_id === $request->user()->id,
            403,
            'You can only update your own blogs.'
        );

        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'required', 'string'],
            'img' => ['nullable', 'image', 'max:5120'],
        ]);

        if ($request->hasFile('img')) {
            if ($blog->img) {
                Storage::disk('public')->delete($blog->img);
            }

            $blog->img = $request->file('img')
                ->store('blogs', 'public');
        }

        if (isset($validated['name'])) {
            $blog->name = $validated['name'];
        }

        if (isset($validated['description'])) {
            $blog->description = $validated['description'];
        }

        $blog->save();

        $blog->load([
            'user:id,name',
            'comments.user:id,name',
        ]);

        $blog->loadCount([
            'likes',
            'comments',
        ]);

        $blog->is_liked = $blog->likes()
            ->where('user_id', $request->user()->id)
            ->exists();

        return response()->json([
            'message' => 'Blog updated successfully',
            'blog' => $blog,
        ]);
    }

    public function destroy(Request $request, Blog $blog)
    {
        abort_unless(
            $blog->user_id === $request->user()->id,
            403,
            'You can only delete your own blogs.'
        );

        if ($blog->img) {
            Storage::disk('public')->delete($blog->img);
        }

        $blog->delete();

        return response()->json([
            'message' => 'Blog deleted successfully',
        ]);
    }
}