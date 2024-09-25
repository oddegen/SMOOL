<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Section;
use App\Models\SectionUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sectionUsers = SectionUser::factory(10)->create();
        $batches = Batch::factory(7)->create();

        foreach ($sectionUsers as $sectionUser) {
            $section = Section::find($sectionUser->section_id);
            $teacher = User::find($sectionUser->teacher_id);

            $subjects = \App\Models\Subject::factory()->create();
            $teacher->subjects()->attach($subjects->pluck('id')->toArray());

            foreach ($batches as $batch) {
                $section->batches()->attach($batch->id, ['year' => now()->year]);
            }
        }
    }
}
