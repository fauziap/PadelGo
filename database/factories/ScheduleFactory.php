<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Waktu acak antara 10:00 dan 21:00
        $start = Carbon::createFromTime(10, 0);
        $end = Carbon::createFromTime(22, 0);

        $startTime = $this->faker->dateTimeBetween($start, $end->copy()->subHour());
        $endTime = (clone $startTime)->modify('+1 hour');

        return [
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $endTime->format('H:i:s'),
        ];
    }
}
