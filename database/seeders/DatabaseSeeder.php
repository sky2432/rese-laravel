<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    const local = [
        GenreSeeder::class,
        local\AdminSeeder::class,
        local\OwnerSeeder::class,
        ShopSeeder::class,
        local\UserSeeder::class,
    ];

    const production = [
        GenreSeeder::class,
        production\AdminSeeder::class,
        production\OwnerSeeder::class,
        ShopSeeder::class,
        production\UserSeeder::class,
    ];
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            $this->call(self::local);
        } elseif (App::environment('production')) {
            $this->call(self::production);
        }
    }
}
