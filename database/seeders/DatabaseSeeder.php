<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@lucas.edu',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
 $this->call([
            UserSeeder::class,
            StudentSeeder::class,
            MemoireSeeder::class,
        ]);
        // Utilisateur simple
        User::create([
            'name' => 'Utilisateur Test',
            'email' => 'user@lucas.edu',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
