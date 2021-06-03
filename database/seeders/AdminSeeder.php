<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
            'name' => 'TopAdmin',
            'email' => 'admin1@test.com',
            'password' => Hash::make('1234'),
            'role' => true,
            'created_at' => now(),
            'updated_at'=> now(),
            ],
            [
            'name' => 'SubAdmin',
            'email' => 'admin2@test.com',
            'password' => Hash::make('1234'),
            'role' => false,
            'created_at' => now(),
            'updated_at'=> now(),
            ],
        ]);
    }
}
