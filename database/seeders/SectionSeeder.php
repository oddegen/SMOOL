<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $batches = Batch::factory(12)->create();

        $batches->each(function ($batch) {
            Section::factory()->count(5)->for($batch)->create();
        });
    }
}
