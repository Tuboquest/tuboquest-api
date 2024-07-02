<?php

namespace Database\Seeders;

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
                'name' => 'John',
                'email' => 'john@tuboquest.fr',
            ]);

        $default->addresses()->create([
            'address' => '13 rue de la paix, 67000 Strasbourg',
            'is_favorite' => true,
        ]);

        $premium = User::factory()
            ->has(Disk::factory())
            ->create([
                'name' => 'Mathias',
                'email' => 'mathias@tuboquest.fr',
                'is_premium' => true,
            ]);

        $premium->addresses()->create([
            'address' => '13 Allée des marquises, 67000, Strasbourg',
            'is_favorite' => true,
        ]);

        // todo: create payment and subscription

        $admin = User::factory()
            ->has(Disk::factory())
            ->create([
                'name' => 'Willy',
                'email' => 'willy@tuboquest.fr',
                'is_admin' => true,
            ]);

        $admin->addresses()->create([
            'address' => '1 rue de Rivétoile, 67000 Strasbourg',
            'is_favorite' => true,
        ]);
    }
}
