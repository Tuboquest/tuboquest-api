<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_update_the_profile()
    {
        // Create a user
        $user = User::factory()->create();

        /** @var \App\Models\User $user */
        $this->actingAs($user);

        $data = [
            'firstname' => 'Updated Name',
        ];

        $response = $this->putJson(route('profile.update'), $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'firstname' => 'Updated Name',
        ]);
    }

    /** @test */
    public function it_can_update_the_avatar()
    {
        // Create a user
        $user = User::factory()->create();

        /** @var \App\Models\User $user */
        $this->actingAs($user);

        // Data to update the avatar
        $data = [
            'avatar' => 'base64-encoded-image',
        ];

        // Hit the updateAvatar endpoint
        $response = $this->putJson(route('profile.update.avatar'), $data);

        // Assert the response status and structure
        $response->assertStatus(200);

        // Assert the database was updated
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'avatar' => 'base64-encoded-image',
        ]);
    }
}
