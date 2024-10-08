<?php

namespace Database\Factories;

use App\Enum\NotificationType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "label" => fake()->sentence(),
            "user_id" => \App\Models\User::factory(),
            "type" => NotificationType::getRandomValue(),
        ];
    }
}
