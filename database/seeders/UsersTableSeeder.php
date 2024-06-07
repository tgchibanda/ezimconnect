<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Admin', 'username' => 'admin', 'status' => 'active', 'role' => 'admin',  'email' => 'admin@example.com', 'password' => Hash::make('password')],
            ['name' => 'Shop', 'username' => 'vendor', 'status' => 'active', 'role' => 'vendor',  'email' => 'vendor@example.com', 'password' => Hash::make('password')],
            ['name' => 'User', 'username' => 'user', 'status' => 'active', 'role' => 'user',  'email' => 'user3@example.com', 'password' => Hash::make('password')],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
