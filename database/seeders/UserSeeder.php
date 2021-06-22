<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
                    [
                        'name' => 'Administrator',
                        'email' => 'admin@grtech.com.my',
                        'password' => Hash::make('password'),
                        'role' => 'admin',
                    ],
                    [
                        'name' => 'User',
                        'email' => 'user@grtech.com.my',
                        'password' => Hash::make('password'),
                        'role' => 'user',
                    ]
                ];

        DB::table('users')->insert($users);
    }
}
