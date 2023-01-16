<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (User::exists()) {
            return;
        }

        $users = [
            [
                'name' => 'Simon',
                'email' => 'simon@gmail.com',
                'password' => Hash::make('123123123'),
            ],
            [
                'name' => 'Kora',
                'email' => 'kora@gmail.com',
                'password' => Hash::make('123123123'),
            ],
            [
                'name' => 'Gleb',
                'email' => 'gleb@gmail.com',
                'password' => Hash::make('123123123'),
            ],
            [
                'name' => 'Ilya',
                'email' => 'ilya@gmail.com',
                'password' => Hash::make('123123123'),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
