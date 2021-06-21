<?php

namespace Database\Seeders\production;

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
        Owner::factory()->count(20)->create([
            'password' => config('const.OWNER_PASSWORD')
        ]);
    }
}
