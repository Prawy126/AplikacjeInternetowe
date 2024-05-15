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
            'end_date' => '2024-05-08',
            'min_price' => 200
        ],

        [
            'user_id' => 1,
            'name' => 'BMW',
            'brand' => 'M',
            'year' => 2021,
            'mileage' => 32.23,
            'description' => 'Samochód w bardzo dobrym stanie pierwszy właściciel.',
            'end_date' => '2024-05-08',
            'min_price' => 20000
        ]]);


    }
}
