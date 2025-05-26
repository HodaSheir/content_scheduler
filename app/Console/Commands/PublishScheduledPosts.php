<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PublishScheduledPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:publish-due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish posts that are scheduled and due';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $duePosts = Post::where('status', 'scheduled')
            ->where('scheduled_time', '<=', Carbon::now())
            ->with('platforms')
            ->get();
        foreach ($duePosts as $post) {
            foreach ($post->platforms as $platform) {
                // Validate post content
                if (strlen($post->content) > $this->getPlatformCharLimit($platform->type)) {
                    Log::warning("Post {$post->id} exceeds character limit for {$platform->type}");
                    continue;
                }

                // Mock publishing
                Log::info("Publishing Post {$post->id} to {$platform->type}");

                // Update pivot platform status
                $post->platforms()->updateExistingPivot($platform->id, [
                    'platform_status' => 'success'
                ]);
            }
            $post->status = 'published';
            $post->save();
        }
        return Command::SUCCESS;
    }

    protected function getPlatformCharLimit($type)
    {
        return match ($type) {
            'twitter' => 280,
            'instagram' => 2200,
            'linkedin' => 3000,
            default => 1000,
        };
    }
}
