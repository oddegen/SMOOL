<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $data = [
            'user_id' => User::factory(),
            'title' => fake()->word(),
            'description' => fake()->sentence(),
            'is_public' => fake()->boolean(),
            'is_announcement' => fake()->boolean(),
            'location' => fake()->secondaryAddress(),
        ];

        if ($data['is_announcement']) {
            $data['start_time'] = null;
            $data['start_date'] = null;
            $data['end_time'] = null;
            $data['end_date'] = null;
        } else {
            $startDateTime = fake()->dateTimeBetween('-1 year', 'now');
            $endDateTime = fake()->dateTimeBetween($startDateTime, '+1 year');
            $data['start_date'] = $startDateTime->format('Y-m-d');
            $data['start_time'] = $startDateTime->format('H:i:s');
            $data['end_date'] = $endDateTime->format('Y-m-d');
            $data['end_time'] = $endDateTime->format('H:i:s');
        }

        return $data;
    }
}
