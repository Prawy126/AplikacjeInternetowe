<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {

        Schema::withoutForeignKeyConstraints(function () {
            Photo::truncate();
        });
        Photo::insert([[
            'announcement_id' => 1,
            'photo_name' => 'samochod.png'
        ],

        [
            'announcement_id' => 1,
            'photo_name' => 'samochod2.png'
        ],

        [
            'announcement_id' => 2,
            'photo_name' => 'BMW.png'
        ],

        [
            'announcement_id' => 2,
            'photo_name' => 'BWM2.png'
        ]
        ]);
    }
}
