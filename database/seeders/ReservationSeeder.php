<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('reservations')->insert([
        //     [
        //         'user_id' => 2,
        //         'shop_id' => 1,
        //         'date' => Carbon::tomorrow(),
        //         'number' => 2,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'user_id' => 2,
        //         'shop_id' => 2,
        //         'date' => Carbon::tomorrow(),
        //         'number' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'user_id' => 3,
        //         'shop_id' => 3,
        //         'date' => Carbon::tomorrow(),
        //         'number' => 2,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'user_id' => 3,
        //         'shop_id' => 4,
        //         'date' => Carbon::tomorrow(),
        //         'number' => 1,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);
    }
}
