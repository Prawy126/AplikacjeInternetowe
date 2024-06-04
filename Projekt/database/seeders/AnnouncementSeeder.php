<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Schema::withoutForeignKeyConstraints(function () {
            Announcement::truncate();
        });

        Announcement::insert([[
            'user_id' => 1,
            'name' => 'Audi',
            'brand' => 'A4',
            'year' => 2000,
            'mileage' => 321.23,
            'description' => 'Samochód w bardzo dobrym stanie pierwszy właściciel.',
            'end_date' => '2024-06-27 18:27',
            'is_end' => false,
            'min_price' => 200
        ],

        [
            'user_id' => 1,
            'name' => 'BMW',
            'brand' => 'M',
            'year' => 2021,
            'mileage' => 32.23,
            'description' => 'Samochód w bardzo dobrym stanie pierwszy właściciel.',
            'end_date' => '2024-06-08',
            'is_end' => false,
            'min_price' => 20000
        ],

        [
            'user_id' => 1,
            'name' => 'Mercedes',
            'brand' => 'C-Class',
            'year' => 2015,
            'mileage' => 65000.50,
            'description' => 'Samochód w bardzo dobrym stanie, regularnie serwisowany.',
            'end_date' => '2024-06-10',
            'is_end' => false,
            'min_price' => 25000
        ],
        [
            'user_id' => 1,
            'name' => 'Volkswagen',
            'brand' => 'Golf',
            'year' => 2019,
            'mileage' => 23000.75,
            'description' => 'Sprzedam szybko, cena do negocjacji.',
            'end_date' => '2024-05-12',
            'is_end' => false,
            'min_price' => 15000
        ],
        [
            'user_id' => 2,
            'name' => 'Toyota',
            'brand' => 'Corolla',
            'year' => 2018,
            'mileage' => 40000.80,
            'description' => 'Samochód w świetnym stanie, bezwypadkowy.',
            'end_date' => '2024-05-15',
            'is_end' => false,
            'min_price' => 18000
        ],
        [
            'user_id' => 2,
            'name' => 'Ford',
            'brand' => 'Focus',
            'year' => 2017,
            'mileage' => 55000.20,
            'description' => 'Sprzedam tanio, szybka transakcja.',
            'end_date' => '2024-05-18',
            'is_end' => false,
            'min_price' => 12000
        ]
    ]);


    }
}
