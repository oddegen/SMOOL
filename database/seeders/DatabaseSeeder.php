<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\SectionUser;
use App\Models\Subject;
use App\Models\User;
use App\Models\Batch;
use App\Models\Event;
use Illuminate\Database\Seeder;
use App\Models\Schedule;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create an admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);

        // Create a teacher
        $teacher = User::factory()->create([
            'name' => 'Teacher',
            'email' => 'teacher1@school.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);

        // Create a student
        $student = User::factory()->create([
            'name' => 'Student',
            'email' => 'student23@email.com',
            'password' => bcrypt('password'),
            'role_id' => 3,
        ]);

        // Create a section and associate it with the student and teacher
        $section = Section::factory()->create();
        SectionUser::factory()->create([
            'section_id' => $section->id,
            'student_id' => $student->id,
            'teacher_id' => $teacher->id,
            'year' => 2024,
        ]);

        // Assign a subject to the teacher
        $subject = Subject::factory()->create([
            'name' => 'Communications',
            'code' => 'COM',
        ]);
        $teacher->subjects()->attach($subject->id);
    }
}
