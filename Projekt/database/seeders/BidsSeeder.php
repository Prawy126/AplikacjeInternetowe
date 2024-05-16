<?php

namespace Database\Seeders;

use App\Models\Bids;
use App\Models\History;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class BidsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Bids::truncate();
        });
        Bids::insert([
            [
                'user_id'=>2,
                'announcement_id'=>1,
                'amount'=>3213,


            ]
        ]);

    }
}
