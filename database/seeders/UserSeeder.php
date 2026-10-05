<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'Admin Demo',
            'email' => 'admin@example.com',
        ]);

        User::factory()->editor()->create([
            'name' => 'Editor Demo',
            'email' => 'editor@example.com',
        ]);

        User::factory()->create([
            'name' => 'User Demo',
            'email' => 'user@example.com',
        ])->assignRole('user');

        User::factory()->create([
            'name' => 'User Kedua',
            'email' => 'user2@example.com',
        ])->assignRole('user');

        User::factory()->count(6)->create()->each(function (User $user) {
            $user->assignRole('user');
        });
    }
}