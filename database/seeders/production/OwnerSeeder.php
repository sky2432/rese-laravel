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
        Owner::factory()->count(20)->create([
            'password' => Hash::make(config('const.OWNER_PASSWORD'))
        ]);
    }
}
