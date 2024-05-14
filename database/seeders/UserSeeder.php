<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'balance' => 1000.00,
                'account_type' => 'individual',
                'email' => 'user@example.com',
                'password' => Hash::make('123456789'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Doe',
                'balance' => 5000.00,
                'account_type' => 'business',
                'email' => 'jane@example.com',
              
                'password' => Hash::make('123456789'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more users as needed
        ];

        // Insert data into 'users' table
        DB::table('users')->insert($users);
    }
}
