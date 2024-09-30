<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{

    protected static ?string $name;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subjects = [
            'Mathematics',
            'Science',
            'History',
            'Geography',
            'English',
            'Computer Science',
            'Physical Education',
            'Art',
            'Music',
            'Drama',
        ];

        static $index = 0;

        if ($index >= count($subjects)) {
            throw new \Exception('No more unique subjects available.');
        }

        $name = $subjects[$index++];

        return [
            'name' => $name,
            'code' => match ($name) {
                'Mathematics' => 'MATH',
                'Science' => 'SCI',
                'History' => 'HIST',
                'Geography' => 'GEO',
                'English' => 'ENG',
                'Computer Science' => 'CS',
                'Physical Education' => 'PE',
                'Art' => 'ART',
                'Music' => 'MUS',
                'Drama' => 'DRA',
            },
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
