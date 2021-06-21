<?php

namespace Database\Seeders\production;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory()->create([
            'name' => 'TopAdmin',
            'email' => 'admin1@test.com',
            'role' => true,
            'password' => config('const.ADMIN_PASSWORD')
        ]);
    }
}
