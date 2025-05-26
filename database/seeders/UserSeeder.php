<?php

namespace Database\Seeders;

use App\Models\Platform;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            $platforms = Platform::inRandomOrder()->take(2)->pluck('id');
            $user->platforms()->sync($platforms);

           Post::factory(1)->create([
                'user_id' => $user->id,
            ])->each(function ($post) use ($platforms) {
                foreach ($platforms as $platformId) {
                    $post->platforms()->attach($platformId, ['platform_status' => 'pending']);
                }
            });
        });
    }
}
