<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = [
            [
                'transaction_type' => 'deposit',
                'amount' => 100.00,
                'fee' => 0,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'transaction_type' => 'withdrawal',
                'amount' => 50.00,
                'fee' => 0,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more transactions as needed
        ];

        // Insert data into 'transactions' table
        DB::table('transactions')->insert($transactions);

    }
}
