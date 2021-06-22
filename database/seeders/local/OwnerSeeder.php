<?php

namespace Database\Seeders\local;

use App\Models\Owner;
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
        Owner::factory()->create([
            'name' => 'ゲストオーナー',
            'email' => config('const.GUEST_EMAIL.OWNER'),
            'api_token' => "1234"
        ]);

        Owner::factory()->create([
            'email' => 'owner1@test.com',
        ]);

        Owner::factory()->count(18)->create();

        Owner::factory()->create([
            'email' => 'owner2@test.com',
            'is_shop' => false,
        ]);
    }
}
