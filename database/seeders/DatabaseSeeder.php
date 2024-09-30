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
            'email' => 'admin1@admin.com',
            'password' => bcrypt('admin'),
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

        // Create batches
        Batch::factory(5)->create();

        // Create events
        Event::factory(20)->create();

        // Create more students and assign them to sections
        User::factory(50)->create(['role_id' => 3, 'password' => bcrypt('password')])->each(function ($student) use ($teacher) {
            $section = Section::inRandomOrder()->first();
            SectionUser::factory()->create([
                'section_id' => $section->id,
                'student_id' => $student->id,
                'teacher_id' => $teacher->id,
                'year' => 2024,
            ]);
        });

        // Create more teachers and assign subjects
        User::factory(10)->create(['role_id' => 2, 'password' => bcrypt('password')])->each(function ($teacher) {
            $subjects = Subject::inRandomOrder()->limit(rand(1, 3))->get();
            $teacher->subjects()->attach($subjects->pluck('id'));
        });

        // Create schedules for the teacher
        $subjects = $teacher->subjects;
        $sections = Section::all();
        $batches = Batch::all();

        foreach ($subjects as $subject) {
            foreach ($sections as $section) {
                $batch = $batches->random();
                $startDate = now()->addDays(rand(1, 30));
                $endDate = $startDate->copy()->addHours(2);

                Schedule::create([
                    'starts_at' => $startDate,
                    'ends_at' => $endDate,
                    'section_id' => $section->id,
                    'user_id' => $teacher->id,
                    'subject_id' => $subject->id,
                    'batch_id' => $batch->id,
                    'school_year' => now()->year,
                ]);
            }
        }
    }
}
