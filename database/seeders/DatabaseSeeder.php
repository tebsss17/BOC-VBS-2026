<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin
        $admin = User::factory()->create([
            'name' => 'Marc Steven Nagamany',
            'email' => 'steven@boc.com',
            'password' => Hash::make('password'),
            'role' => 'Admin',
            'group' => 'Superadmin'
        ]);

        User::factory()->create([
            'name' => 'Hazee Ilao',
            'email' => 'hazee@boc.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
            'group' => 'superadmin'
        ]);

        // Seed students and lessons
        $students = Student::factory(15)->create();
        $lessons  = Lesson::factory(4)->create();

        // Seed teachers
        $teachers = User::factory(5)->create();

        // Define attendance dates
        $dates = [
            '2026-05-11',
            '2026-05-12',
            '2026-05-13',
            '2026-05-14',
        ];

        // Loop through students × dates ONLY
        foreach ($students as $student) {
            foreach ($dates as $date) {
                Attendance::create([
                    'student_id' => $student->id,
                    'user_id'    => $teachers->random()->id,
                    'date'       => $date,
                    'present'    => fake()->boolean(85), // Mas mataas na chance para magmukhang legit
                ]);
            }
        }
    }

}
