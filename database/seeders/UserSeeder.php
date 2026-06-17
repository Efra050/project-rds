<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Usuario Prueba',
            'email' => 'test@example.com',
            'password' => 'password123',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'admin123',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'efrain',
            'email' => 'efra@example.com',
            'password' => 'efrain12345',
            'email_verified_at' => now(),
        ]);
         
    }
}
    