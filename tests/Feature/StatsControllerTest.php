<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use App\Models\Movement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class StatsControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_counts_movements_per_month_for_the_authenticated_user()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // Create movements for the user in different months
        Movement::factory()->for($user)->create(['created_at' => now()->subMonth(2)]);
        Movement::factory()->for($user)->create(['created_at' => now()->subMonth(1)]);
        Movement::factory()->for($user)->create(['created_at' => now()->subMonth(1)]);
        Movement::factory()->for($user)->create(['created_at' => now()]);

        // Simulate authenticated user
        $this->actingAs($user);

        // Hit the countOfUse endpoint
        $response = $this->getJson(route('statistics.count-of-use'));

        // Assert the response status and structure
        $response->assertStatus(200)
            ->assertJson([
                now()->format('F') => 1,
                now()->subMonth(1)->format('F') => 2,
                now()->subMonth(2)->format('F') => 1,
            ]);
    }
}
