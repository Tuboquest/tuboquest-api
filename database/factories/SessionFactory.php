<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Disk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'disk_id' => Disk::factory(),
            'started_at' => fake()->dateTime(),
            'ended_at' => fake()->dateTime(now()->addHours(5)),
            'address_id' => Address::factory(),
            'is_current' => false,
        ];
    }
}
