<?php

namespace Database\Factories;

use App\Models\Videos;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideosFactory extends Factory
{
    protected $model = Videos::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'url' => $this->faker->url(),
            'published_at' => $this->faker->date(),
            'previous' => $this->faker->optional()->word(),
            'next' => $this->faker->optional()->word(),
            'series_id' => $this->faker->optional()->randomDigit(),
        ];
    }
}
