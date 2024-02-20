<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a single user with a hashed password
        User::create([
            'name' => 'Nedim Kulašin',
            'email' => 'admin@example.com',
            'password' => Hash::make('Admin1234!'),
        ]);
    }
}

