<?php

namespace Database\Factories;

use App\Models\Section;
use App\Models\User;
use App\Models\SectionUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SectionUser>
 */
class SectionUserFactory extends Factory
{
    protected $model = SectionUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'section_id' => Section::factory(),
            'student_id' => User::factory()->create([
                'role_id' => 3,
            ]),
            'teacher_id' => User::factory()->create([
                'role_id' => 2,
            ]),
            'year' => fake()->year(),
        ];
    }
}
