<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'image_url' => $this->faker->imageUrl(640, 480, 'business', true),
            'scheduled_time' => now()->addDays(rand(1, 10)),
            'status' => 'scheduled',
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
