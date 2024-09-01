<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Disk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DiskControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_lists_unpaired_disks()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // Simulate authenticated user
        $this->actingAs($user);

        // Create some disks
        Disk::factory()->count(3)->create(['is_paired' => false]);
        Disk::factory()->count(2)->create(['is_paired' => true]);

        // Hit the index endpoint
        $response = $this->getJson(route('disks.index'));

        // Assert that only unpaired disks are returned
        $response->assertStatus(200)
            ->assertJsonCount(5);
    }

    /** @test */
    public function it_pairs_a_disk_with_a_user()
    {
        // Create a user
        /**  @var \App\Models\User $user */
        $user = User::factory()->create();

        // Create a disk
        $disk = Disk::factory()->create([
            'is_paired' => false,
            'pairing_code' => '123456',
            'user_id' => null,
        ]);

        // Simulate authenticated user
        $this->actingAs($user);

        // Data to pair the disk
        $data = [
            'pairing_code' => '123456',
        ];

        // Hit the pair endpoint
        $response = $this->postJson(route('disks.pair', $disk), $data);

        // Assert the response status and structure
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Disk paired successfully',
            ]);

        // Assert the disk was paired
        $this->assertDatabaseHas('disks', [
            'id' => $disk->id,
            'is_paired' => true,
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function it_fails_to_pair_if_disk_is_already_paired()
    {
        // Create a user and a paired disk
        /**  @var \App\Models\User $user */
        $user = User::factory()->create();
        $disk = Disk::factory()->create([
            'is_paired' => true,
            'user_id' => User::factory()->create()->id,
        ]);

        // Simulate authenticated user
        $this->actingAs($user);

        // Data to attempt pairing
        $data = [
            'pairing_code' => $disk->pairing_code,
        ];

        // Hit the pair endpoint
        $response = $this->postJson(route('disks.pair', $disk), $data);

        // Assert the response status and structure
        $response->assertStatus(400)
            ->assertJson([
                'message' => 'Disk already paired',
            ]);
    }

    /** @test */
    public function it_fails_to_pair_with_invalid_code()
    {
        // Create a user and a disk
        /**  @var \App\Models\User $user */
        $user = User::factory()->create();
        $disk = Disk::factory()->create([
            'is_paired' => false,
            'pairing_code' => '123456',
            'user_id' => null,
        ]);

        // Simulate authenticated user
        $this->actingAs($user);

        // Data with an invalid pairing code
        $data = [
            'pairing_code' => 'wrongcode',
        ];

        // Hit the pair endpoint
        $response = $this->postJson(route('disks.pair', $disk), $data);

        // Assert the response status and structure
        $response->assertStatus(400)
            ->assertJson([
                'message' => 'Invalid pairing code',
            ]);
    }

    /** @test */
    public function it_unpairs_a_disk()
    {
        // Create a user and a paired disk
        /**  @var \App\Models\User $user */
        $user = User::factory()->create();
        $disk = Disk::factory()->create([
            'is_paired' => true,
            'user_id' => $user->id,
        ]);

        // Simulate authenticated user
        $this->actingAs($user);

        // Hit the unpair endpoint
        $response = $this->postJson(route('disks.unpair', $disk));

        // Assert the response status and structure
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Disk unpaired successfully',
            ]);

        // Assert the disk was unpaired
        $this->assertDatabaseHas('disks', [
            'id' => $disk->id,
            'is_paired' => false,
            'user_id' => null,
        ]);
    }

    /** @test */
    public function it_fails_to_unpair_if_not_owned_by_user()
    {
        // Create two users and a disk paired with the first user
        /**  @var \App\Models\User $user1 */
        $user1 = User::factory()->create();
        /**  @var \App\Models\User $user2 */
        $user2 = User::factory()->create();
        $disk = Disk::factory()->create([
            'is_paired' => true,
            'user_id' => $user1->id,
        ]);

        // Simulate authenticated user who doesn't own the disk
        $this->actingAs($user2);

        // Hit the unpair endpoint
        $response = $this->postJson(route('disks.unpair', $disk));

        // Assert the response status and structure
        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthorized',
            ]);
    }
}
