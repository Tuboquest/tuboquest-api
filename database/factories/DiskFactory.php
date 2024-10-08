<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Disk>
 */
class DiskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'serial_number' => Str::random(20),
            'token' => Str::random(200),
            'name' => fake()->name(),
            'host' => fake()->ipv4(),
            'is_paired' => fake()->boolean(),
            'user_id' => null,
            'angle' => 0,
            'pairing_code' => fake()->numberBetween(1000, 9999),
        ];
    }
}
