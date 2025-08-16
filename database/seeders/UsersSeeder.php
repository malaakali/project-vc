<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Guest User',
                'email' => 'guest@example.com',
                'phone_number' => '+1234567890',
                'user_type' => 'guest',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'phone_number' => '+1234567891',
                'user_type' => 'admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Ticket Officer',
                'email' => 'ticket.officer@example.com',
                'phone_number' => '+1234567892',
                'user_type' => 'ticket_officer',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Receptionist',
                'email' => 'receptionist@example.com',
                'phone_number' => '+1234567893',
                'user_type' => 'receptionist',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}