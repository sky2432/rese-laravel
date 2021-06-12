<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GenreSeeder::class,
            AdminSeeder::class,
            OwnerSeeder::class,
            ShopSeeder::class,
            UserSeeder::class,
        ]);
    }
}
