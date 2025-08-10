<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456'),
            'phone' => '0123456789',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User Test',
            'email' => 'user@example.com',
            'password' => Hash::make('123456'),
            'phone' => '0987654321',
            'role' => 'user',
        ]);
    }
}
