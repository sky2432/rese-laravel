<?php

namespace Database\Seeders\local;

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
        ]);
        Admin::factory()->create([
            'name' => 'SubAdmin',
            'email' => 'admin2@test.com',
            'role' => false,
        ]);
    }
}
