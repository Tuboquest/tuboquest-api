<?php

namespace Database\Seeders;

use App\Enum\NotificationType;
use App\Models\Disk;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Disk::factory(5)->create();

        $default = User::factory()
            ->has(Disk::factory())
            ->create([
                'firstname' => 'John',
                'lastname' => 'Doe',
                'email' => 'john@tuboquest.fr',
            ]);

        $default->addresses()->create([
            'address' => '13 rue de la paix, 67000 Strasbourg',
            'is_favorite' => true,
        ]);

        $premium = User::factory()
            ->has(Disk::factory())
            ->create([
                'firstname' => 'Mathias',
                'lastname' => 'Eldigos',
                'email' => 'mathias@tuboquest.fr',
                'is_premium' => true,
            ]);

        $premium->addresses()->create([
            'address' => '13 Allée des marquises, 67000, Strasbourg',
            'is_favorite' => true,
        ]);

        $admin = User::factory()
            ->create([
                'firstname' => 'Willy',
                'lastname' => 'Wonka',
                'email' => 'willy@tuboquest.fr',
                'is_admin' => true,
            ]);
        $admin->addresses()->create([
            'address' => '1 rue de Rivétoile, 67000 Strasbourg',
            'is_favorite' => true,
        ]);
        Disk::factory()->create([
            'name' => 'Raspberry Pi',
            'user_id' => $admin->id,
            'host' => '172.20.10.7:8000',
            'pairing_code' => "1234",
            'is_paired' => true,
            'token' => '290d14b238273fe1ec455418ceb6fbd3ebf77e7b4a91f15432a8f4a61c9bf67e',
        ]);

        User::factory()
            ->create([
                'firstname' => 'Alexis',
                'lastname' => 'Henry',
                'email' => 'alexis.henry150357@gmail.com'
            ]);

        User::factory()
            ->create([
                'firstname' => 'Benjamin',
                'lastname' => 'Faechtig',
                'email' => 'benjamin.faechtig@gmail.com'
            ]);

        User::all()->each(function (User $user) {
            $user->notifications()->create([
                'label' => 'Welcome to TuboQuest',
                'type' => NotificationType::getRandomValue()
            ]);
        });
    }
}
