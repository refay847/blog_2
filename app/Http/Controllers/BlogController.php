<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user:id,name')
            ->latest()
            ->get();

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

        return response()->json([
            'message' => 'Blog created successfully',
            'blog' => $blog->load('user:id,name'),
        ], 201);
    }

    public function show(Blog $blog)
    {
        return response()->json([
            'blog' => $blog->load('user:id,name'),
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

        return response()->json([
            'message' => 'Blog updated successfully',
            'blog' => $blog->load('user:id,name'),
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