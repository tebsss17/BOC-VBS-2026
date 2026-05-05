<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'day' => fake()->numberBetween(1,4),
            'title' => fake()->sentence(3),
            'description' => fake()->sentence(6),
            'memory_verse' => fake()->sentence(4),
        ];
    }
}
