<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear all existing users to ensure a clean state for seeding
        User::truncate();

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create admin user
        User::create([
            'name' => 'Admin HappyCare',
            'username' => 'admin',
            'email' => 'admin@happycare.id',
            'password' => Hash::make('password123'),
            'phone' => '081234567890',
            'address' => 'Jl. Pemuda No. 123, Semarang',
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        // Create sample regular user
        User::create([
            'name' => 'Diana Novi',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567891',
            'address' => 'Jl. Sudirman No. 456, Semarang',
            'date_of_birth' => '1990-01-15',
            'gender' => 'male',
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'username' => 'admin2',
                'password' => Hash::make('password123'),
                'is_admin' => 1,
            ]
        );
    }
}