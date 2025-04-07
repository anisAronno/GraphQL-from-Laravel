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
            "title"=> ucfirst(fake()->words(3, true)),
            "body"=> fake()->paragraphs(3, true),
            "user_id" => User::inRandomOrder()->first()->id,
            "created_at"=> fake()->dateTimeBetween("-30days",now()),
        ];
    }
}
