<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Platform;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $scheduledPosts = Post::where('status', 'scheduled')->count();
        $publishedPosts = Post::where('status', 'published')->count();
        $platformStats = Platform::withCount('posts')->get();

        $successRate = $publishedPosts + $scheduledPosts > 0
            ? round(($publishedPosts / ($publishedPosts + $scheduledPosts)) * 100, 2)
            : 0;

        return view('admin.dashboard', compact('scheduledPosts', 'publishedPosts', 'platformStats', 'successRate'));
    }
}
