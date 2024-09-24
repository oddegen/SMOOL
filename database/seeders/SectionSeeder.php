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
        Batch::factory(7)->has(Section::factory(5))->create();
    }
}
