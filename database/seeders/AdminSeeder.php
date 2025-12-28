<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@rental.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
                'is_staff' => true,
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@rental.com'],
            [
                'name' => 'Staff',
                'password' => Hash::make('staff123'),
                'is_admin' => false,
                'is_staff' => true,
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@rental.com'],
            [
                'name' => 'User',
                'password' => Hash::make('user123'),
                'is_admin' => false,
                'is_staff' => false,
                'email_verified_at' => now(),
            ]
        );
    }
}
