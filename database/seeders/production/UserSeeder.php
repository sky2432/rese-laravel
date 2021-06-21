<?php

namespace Database\Seeders\production;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'ゲスト',
            'email' => 'guest@guest.com',
            'api_token' => "1234"
        ]);
    }
}
