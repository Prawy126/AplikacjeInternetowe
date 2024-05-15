<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Bids;
use App\Models\History;
use App\Models\Photo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        //Uruchamia wszystkie seedery
        $this->call([
            UserSeeder::class,
            AnnouncementSeeder::class,
            PhotoSeeder::class,




            BidsSeeder::class

        ]);
    }
}
