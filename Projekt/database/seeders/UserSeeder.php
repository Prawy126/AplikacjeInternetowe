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
            'phone_number' => 1234132,
            'role' => 'user'
        ],
        [
            'name' => 'Adam',
            'surname' => 'Nowak',
            'email' => 'nowak@mail.com',
            'password' => Hash::make('1234'),
            'address' => 'Ulica',
            'phone_number' => 123413312,
            'role' => 'user'
        ],
        [
            'name' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('1234'),
            'address' => 'Admin',
            'phone_number' => 123413312,
            'role' => 'admin'
        ],

    ]);
    }
}
