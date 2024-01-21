<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $likable = $this->likeable();
        return [
            'user_id' => rand(1,13),
            'likeable_type' => $likable ,
            'likeable_id' => $likable::factory() ,
            'vote' => $this->faker->randomElement([1,-1]), 
        ];
    }

    private function likeable()
    {
        return $this->faker->randomElement([
            Video::class,
            Comment::class,
        ]);
    }
}
