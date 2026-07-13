<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone_number' => $this->faker->phoneNumber(),
            'booking_date' => now()->format('Y-m-d'),
            'payment_status' => $this->faker->randomElement(['pending', 'success', 'challenge', 'failed']),
            'user_id' => 1, // Bisa di override dari seeder
            'court_id' => 1, // Bisa di override dari seeder
            'schedule_id' => 1, // Bisa di override dari seeder
            'snap_token' => $this->faker->uuid(),
            'order_id' => $this->faker->uuid(),
        ];
    }
}
