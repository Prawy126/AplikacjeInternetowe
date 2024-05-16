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
            'photo_name' => 'AUDI1.png'
        ],

        [
            'announcement_id' => 1,
            'photo_name' => 'AUDI2.png'
        ],

        [
            'announcement_id' => 2,
            'photo_name' => 'BMW2.jpeg'
        ],

        [
            'announcement_id' => 2,
            'photo_name' => 'BMW.jpeg'
        ],

        [
            'announcement_id' => 3,
            'photo_name' => 'MERCEDES_C_CLASS.jpeg'
        ],

        [
            'announcement_id' => 3,
            'photo_name' => 'MERCEDES_C_CLASS.jpg'
        ],
        [
            'announcement_id' => 4,
            'photo_name' => 'GOLF4.png'
        ],
        [
            'announcement_id' => 4,
            'photo_name' => 'GOLF4_1.jpg'
        ],

        [
            'announcement_id' => 4,
            'photo_name' => 'GOLF4_2.jpeg'
        ],
        [
            'announcement_id' => 5,
            'photo_name' => 'TOYOTA1.jpg'
        ],
        [
            'announcement_id' => 5,
            'photo_name' => 'TOYOTA2.jpeg'
        ],
        [
            'announcement_id' => 5,
            'photo_name' => 'TOYOTA3.jpeg'
        ],
        [
            'announcement_id' => 5,
            'photo_name' => 'TOYOTA4.jpg'
        ],
        [
            'announcement_id' => 6,
            'photo_name' => 'FOCUS.jpg'
        ],
        [
            'announcement_id' => 6,
            'photo_name' => 'FOCUS2.jpeg'
        ],
        [
            'announcement_id' => 6,
            'photo_name' => 'FOCUS3.jpg'
        ]


        ]);
    }
}
