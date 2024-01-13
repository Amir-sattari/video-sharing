<?php

namespace Database\Factories;

use App\Models\Category;
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
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'url' => $this->faker->imageUrl(640,480,'animal',true),
            'length' => $this->faker->randomNumber(3),
            'description' => $this->faker->text(),
            'thumbnail' => 'https://loremflickr.com/446/240/world?random=' . rand(1,99),
            'category_id' => rand(1,7) ?? Category::factory(),
        ];
    }
}
