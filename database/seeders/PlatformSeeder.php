<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Platform;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $platforms = [
            ['name' => 'Twitter', 'type' => 'twitter'],
            ['name' => 'Instagram', 'type' => 'instagram'],
            ['name' => 'LinkedIn', 'type' => 'linkedin'],
            ['name' => 'Facebook', 'type' => 'facebook'],
            ['name' => 'TikTok', 'type' => 'tiktok'],
            ['name' => 'Pinterest', 'type' => 'pinterest'],
            ['name' => 'Snapchat', 'type' => 'snapchat'],
            ['name' => 'Reddit', 'type' => 'reddit'],
            ['name' => 'YouTube', 'type' => 'youtube'],
            ['name' => 'Threads', 'type' => 'threads'],
        ];

        foreach ($platforms as $platform) {
            Platform::create($platform);
        }
    }
}
