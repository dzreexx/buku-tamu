<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\News;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $body = fake()->text(1000);
        return [
            'judul' => fake()->sentence(),
            // 'thumb_path' => fake()->imageUrl($width = 640, $height = 480),
            'thumb_path' => null,
            'body' => $body,
            'excerpt' => Str::limit(strip_tags($body), 50),
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => 1,
        ];
    }
}
