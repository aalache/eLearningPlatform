<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'url' => 'https://www.youtube.com/watch?v=pFtxR-O78sY',
            'duration' => 10,
            // 'playlist_id' => Playlist::factory(),
        ];
    }
}
