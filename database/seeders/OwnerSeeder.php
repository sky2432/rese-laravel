<?php

namespace Database\Seeders;

use App\Models\Owner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('owners')->insert([
            [
            'name' => 'owner',
            'email' => 'owner@test.com',
            'password' => Hash::make('1234'),
            'created_at' => now(),
            'updated_at'=> now(),
            ],
        ]);

        Owner::factory()->count(19)->create();
    }
}
