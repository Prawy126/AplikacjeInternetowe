<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            User::truncate();
        });

        User::insert([[
            'name' => 'Michał',
            'surname' => 'Pilecki',
            'email' => 'michal2@mail.com',
            'password' => Hash::make('1234'),
            'address' => 'Ulica',
            'phone_number' => 123415092,
            'role' => 'user'
        ],
        [
            'name' => 'Adam',
            'surname' => 'Nowak',
            'email' => 'nowak@mail.com',
            'password' => Hash::make('1234'),
            'address' => 'Ulica',
            'phone_number' => 123413359,
            'role' => 'user'
        ],
        [
            'name' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('1234'),
            'address' => 'Admin',
            'phone_number' => 123413343,
            'role' => 'admin'
        ],

        [
            'name' => 'Maciej',
            'surname' => 'Kowalski',
            'email' => 'kowal@mail.com',
            'password' => Hash::make('1234'),
            'address' => 'Dobra 6',
            'phone_number' => 123413323,
            'role' => 'user'
        ],

    ]);
    }
}
