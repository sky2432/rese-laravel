<?php

namespace Database\Seeders\production;

use App\Models\Admin;
use Illuminate\Database\Seeder;
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
        Admin::factory()->create([
            'name' => 'TopAdmin',
            'email' => config('const.ADMIN_EMAIL'),
            'role' => true,
            'password' => Hash::make(config('const.ADMIN_PASSWORD'))
        ]);
    }
}
