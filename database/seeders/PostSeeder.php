<?php

namespace Database\Seeders;

use App\Models\Platform;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory(10)->create()->each(function ($post) {
            $platforms = Platform::inRandomOrder()->take(2)->pluck('id');
            $post->platforms()->sync($platforms);
        });
    }
}
