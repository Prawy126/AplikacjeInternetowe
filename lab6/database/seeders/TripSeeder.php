<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $trips = [
            [
                'name' => 'Kolorado',
                'continent' => 'Ameryka Północna',
                'period' => 7,
                'description' => 'jest wyżynno-górzystym stanem, którego średnia wysokość nad poziomem morza przekracza 2000 m. Najwyższy szczyt Kolorado, Mount Elbert, wznosi się na 4399 m n.p.m.',
                'price' => 19000.00,
                'img' => 'colorado.jpg',
                'country_id' => 1, // Załóżmy, że ID USA to 1
            ],
            [
                'name' => 'Alaska',
                'continent' => 'Ameryka Północna',
                'period' => 10,
                'description' => 'pasmo górskie w Ameryce Północnej w stanie Alaska. Jest to najwyższa część łańcucha Kordylierów z najwyższym szczytem kontynentu - Denali (McKinley) (6194 m n.p.m.).',
                'price' => 24000.00,
                'img' => 'alaska.jpg',
                'country_id' => 1, // Załóżmy, że ID USA to 1
            ],
            [
                'name' => 'Everest',
                'continent' => 'Azja',
                'period' => 7,
                'description' => 'najwyższy szczyt Ziemi (8848 m n.p.m.), ośmiotysięcznik położony w Himalajach Wysokich, na granicy Nepalu i Tybetu.',
                'price' => 22000.00,
                'img' => 'everest.jpg',
                'country_id' => 2, // Zakładając, że Chiny mają ID 2
            ],
            [
                'name' => 'Alpy',
                'continent' => 'Europa',
                'period' => 6,
                'description' => 'najwyższy łańcuch górski Europy, ciągnący się łukiem od wybrzeża Morza Śródziemnego do doliny Dunaju.',
                'price' => 16000.00,
                'img' => 'alps.jpg',
                'country_id' => 3, // Zakładając, że Austria ma ID 3
            ],
            [
                'name' => 'Kilimandżaro',
                'continent' => 'Afryka',
                'period' => 10,
                'description' => 'góra w Tanzanii, najwyższa góra Afryki, z całorocznym śniegiem.',
                'price' => 25000.00,
                'img' => 'kilimanjaro.jpg',
                'country_id' => 4, // Zakładając, że Tanzania ma ID 4
            ],
            [
                'name' => 'Tatry',
                'continent' => 'Europa',
                'period' => 5,
                'description' => 'najwyższe pasmo w łańcuchu Karpat, z najwyższym szczytem Rysy.',
                'price' => 7500.00,
                'img' => 'tatry.jpg',
                'country_id' => 5, // Zakładając, że Polska ma ID 5
            ],
            [
                'name' => 'Sudety',
                'continent' => 'Europa',
                'period' => 5,
                'description' => 'łańcuch górski na obszarze Polski i Czech, z najwyższym szczytem Śnieżka.',
                'price' => 8000.00,
                'img' => 'sudety.jpg',
                'country_id' => 5, // Zakładając, że Polska ma ID 5
            ]
        ];

        DB::table('trips')->insert($trips);
    }
}
