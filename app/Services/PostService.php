<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\Request;

class PostService
{
  public function list(Request $request)
  {
    return Post::with('platforms')
      ->where('user_id', $request->user()->id)
      ->when($request->status, fn($q) => $q->where('status', $request->status))
      ->when($request->date, fn($q) => $q->whereDate('scheduled_time', $request->date))
      ->latest()
      ->paginate(10);
  }

  public function create(array $data, $user)
  {
    $post = $user->posts()->create($data);
    $post->platforms()->syncWithPivotValues($data['platforms'], ['platform_status' => 'pending']);
    return $post->load('platforms');
  }

  public function update($id, array $data, $user)
  {
    $post = Post::where('user_id', $user->id)->where('status', '!=', 'published')->findOrFail($id);
    $post->update($data);

    if (isset($data['platforms'])) {
      $post->platforms()->syncWithPivotValues($data['platforms'], ['platform_status' => 'pending']);
    }

    return $post->load('platforms');
  }

  public function delete($id, $user)
  {
    $post = Post::where('user_id', $user->id)->findOrFail($id);
    $post->platforms()->detach();
    $post->delete();
    return response()->json(['message' => 'Post deleted successfully.']);
  }
}
