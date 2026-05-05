<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'age' => fake()->numberBetween(4,12),
            'address' => fake()->randomElement(['acapulco', 'parca 2', 'lower parca', 'zone 6']),
            'group' => fake()->randomElement(['tourists', 'site seers' ,'way farers']),
        ];
    }
}
