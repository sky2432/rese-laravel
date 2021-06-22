<?php

namespace Database\Seeders\production;

use App\Models\Owner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Owner::factory()->create([
            'name' => 'ゲストオーナー',
            'email' => config('const.GUEST_EMAIL.OWNER'),
            'api_token' => "1234"
        ]);

        Owner::factory()->count(19)->create([
            'password' => Hash::make(config('const.PASSWORD.OWNER'))
        ]);
    }
}
