<?php

namespace Tests\Unit\Models;

use App\Models\Ranking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScoreboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_top_rankings()
    {
        // Create some rankings with different scores
        Ranking::factory()->create(['name' => 'Alice', 'score' => 100]);
        Ranking::factory()->create(['name' => 'Bob', 'score' => 200]);
        Ranking::factory()->create(['name' => 'Charlie', 'score' => 50]);

        // Get the top rankings (assuming 'top' returns rankings sorted by score descending)
        $topRankings = Ranking::top();

        // Assert that the top ranking is the one with the highest score
        $this->assertEquals('Bob', $topRankings->first()->name);
        $this->assertEquals(200, $topRankings->first()->score);
    }

    /** @test */
    public function it_can_create_a_ranking()
    {
        // Data for a new ranking
        $data = [
            'name' => 'John Doe',
            'score' => 100,
        ];

        // Create the ranking
        Ranking::create($data);

        // Assert that the ranking was created correctly
        $this->assertDatabaseHas('rankings', $data);
    }
}
