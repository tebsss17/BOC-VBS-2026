<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'user_id' => User::factory(),
            'lesson_id' => Lesson::factory(),
            'date' => fake()->dateTimeBetween('2026-05-11', '2026-05-14'),
            'present' => fake()->boolean(70),

        ];
    }
}
