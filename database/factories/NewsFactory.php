<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->unique()->slug(),
            'content' => $this->faker->paragraph(5),
            'thumbnail' => "news/20250529084918_torkata-launching.png",
            'news_category_id' => $this->faker->numberBetween(1, 3),
            'user_id' => 1,
            'status' => 'published',
            'meta_title' => $this->faker->sentence(),
            'meta_description' => $this->faker->paragraph(2),
            'meta_keywords' => implode(',', $this->faker->words(3)),
        ];
    }
}
