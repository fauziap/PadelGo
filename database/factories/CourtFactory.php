<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Court>
 */
class CourtFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Lapangan ' . $this->faker->randomElement(['A', 'B', 'C']),
            'price' => (string) $this->faker->numberBetween(50000, 150000), // harga dalam string
            'image_url' => '',
        ];
    }
}
