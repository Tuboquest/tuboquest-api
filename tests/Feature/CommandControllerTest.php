<?php

namespace Tests\Feature;

use App\Commands\Command;
use App\Models\Disk;
use App\Models\Movement;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommandControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_rotates_the_disk_successfully_if_owned(): void
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // Simulate authenticated user
        $this->actingAs($user);

        // Create a disk
        $disk = Disk::factory()->create([
            'user_id' => $user->id,
        ]);

        // Data to rotate the disk
        $data = [
            'angle' => 90,
        ];

        Command::$fakeRequests = true;

        // Hit the rotate endpoint
        $response = $this->postJson(route('command.rotate'), $data);

        // Assert the response status and structure
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Disk rotated successfully',
            ]);

        // Assert the database was updated
        $this->assertDatabaseHas('disks', [
            'id' => $disk->id,
            'angle' => 90,
        ]);
    }

    /** @test */
    public function it_fails_to_rotate_the_disk_if_not_owned(): void
    {
        // Create a user
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // Simulate authenticated user
        $this->actingAs($user);

        // Create a disk
        $disk = Disk::factory()->create();

        // Data to rotate the disk
        $data = [
            'angle' => 90,
        ];

        Command::$fakeRequests = true;

        // Hit the rotate endpoint
        $response = $this->postJson(route('command.rotate'), $data);

        // Assert the response status and structure
        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Disk not found',
            ]);

        // Assert the database was not updated
        $this->assertDatabaseHas('disks', [
            'id' => $disk->id,
            'angle' => 0,
        ]);
    }
}
