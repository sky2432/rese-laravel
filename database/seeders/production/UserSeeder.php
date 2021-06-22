<?php

namespace Database\Seeders\production;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Services\UserSeederService;
use Illuminate\Support\Facades\Hash;

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
            'email' => config('const.GUEST_EMAIL.USER'),
            'api_token' => "1234"
        ]);

        User::factory(9)->create([
            'password' => Hash::make(config('const.PASSWORD.USER'))
        ])->each(function (User $user) {
            UserSeederService::createPivotTable($user);
        });
    }
}
