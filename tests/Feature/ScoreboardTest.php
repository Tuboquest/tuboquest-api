<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Ranking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScoreboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_rankings()
    {
        // Create some rankings
        $rankings = Ranking::factory()->count(3)->create();

        // Hit the index endpoint
        $response = $this->getJson(route('scoreboard.index'));

        // Assert a 200 status code and correct structure
        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['name', 'score'],
            ]);
    }

    /** @test */
    public function it_can_store_a_new_ranking()
    {
        // Data to send
        $data = [
            'name' => 'John Doe',
            'score' => 100,
        ];

        // Hit the store endpoint
        $response = $this->postJson(route('scoreboard.store'), $data);

        // Assert that the response status is 201 and correct structure
        $response->assertStatus(201)
            ->assertJsonStructure([
                'name',
                'score',
            ]);

        // Assert the ranking was created
        $this->assertDatabaseHas('rankings', $data);
    }
}
