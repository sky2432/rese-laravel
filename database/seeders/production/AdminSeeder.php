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
            'name' => 'ゲスト管理者',
            'email' => config('const.GUEST_EMAIL.ADMIN'),
            'role' => true,
            'api_token' => "1234"
        ]);

        Admin::factory()->create([
            'name' => 'TopAdmin',
            'email' => 'admin1@rese.com',
            'role' => true,
            'password' => Hash::make(config('const.PASSWORD.ADMIN'))
        ]);

        Admin::factory()->create([
            'name' => 'SubAdmin',
            'email' => 'admin2@rese.com',
            'role' => false,
            'password' => Hash::make(config('const.PASSWORD.ADMIN'))
        ]);
    }
}
