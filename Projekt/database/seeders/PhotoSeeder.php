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
            'photo_name' => 'img/BWM2.png'
        ]
        ]);
    }
}
