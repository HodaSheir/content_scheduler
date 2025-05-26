<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Platform;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('platforms', 'user')
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->date, fn($q) => $q->whereDate('scheduled_time', $request->date))
            ->latest()
            ->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function edit($id)
    {
        $post = Post::with('platforms')->findOrFail($id);
        $platforms = Platform::all();
        return view('admin.posts.edit', compact('post', 'platforms'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->only(['title', 'content', 'scheduled_time', 'status']));
        $post->platforms()->sync($request->platform_ids);
        return redirect()->route('admin.posts.index')->with('success', 'Post updated.');
    }
}
