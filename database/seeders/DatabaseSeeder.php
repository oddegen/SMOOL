<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\SectionUser;
use App\Models\Subject;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Subject::factory(10)->create();

        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@admin.com',
        //     'password' => bcrypt('admin'),
        //     'role_id' => 1,
        // ]);

        $teacher = User::factory()->create([
            'name' => 'Teacher',
            'email' => 'teacher@school.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);

        SectionUser::factory()->create([
            'section_id' => Section::factory()->create()->id,
            'student_id' => User::factory()->create([
                'name' => 'Student',
                'email' => 'student@email.com',
                'password' => bcrypt('password'),
                'role_id' => 3,
            ])->id,
            'teacher_id' => $teacher->id,
            'year' => 2024,
        ]);


        $teacher->subjects()->attach(Subject::factory()->create([
            'name' => 'Ecology',
            'code' => 'ECO101',
        ])->id);
    }
}
