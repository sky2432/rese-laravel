<?php

namespace Database\Seeders\local;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Services\UserSeederService;

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
            'email' => 'guest@user.com',
            'api_token' => "1234"
        ]);

        $user1 = User::factory()->create([
            'name' => 'そら',
            'email' => 'user1@test.com',
        ]);

        $user2 = User::factory()->create([
            'email' => 'user2@test.com',
        ]);

        UserSeederService::createPivotTable($user1);
        UserSeederService::createPivotTable($user2);

        //ユーザー作成と共に、それぞれのユーザーごとに予約・評価・お気に入りデータを作成
        User::factory(7)->create()->each(function (User $user) {
            UserSeederService::createPivotTable($user);
        });
    }
}
