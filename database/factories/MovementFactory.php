<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movement>
 */
class MovementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "disk_id" => \App\Models\Disk::factory(),
            "user_id" => \App\Models\User::factory(),
            "angle" => $this->faker->numberBetween(0, 360),
        ];
    }
}
