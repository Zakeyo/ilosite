<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Zakeyo',
            'email' => 'manuelc.dev@gmail.com',
            'password' => Hash::make('123456789'),
        ]);

        User::factory()->create([
            'name' => 'Renox1527',
            'email' => 'reny.alvarezxd@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
    }
}