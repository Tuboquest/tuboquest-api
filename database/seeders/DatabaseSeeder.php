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
            'token' => '9ce7894750a47ae9406ae8fc29263989cf41ca66e4d538f22698d012456d3c12',
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
