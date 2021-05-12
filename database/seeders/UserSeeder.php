<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as FakerFactory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('1234'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at'=> now(),
            ],
            [
            'name' => 'そら',
            'email' => 'test1@test.com',
            'password' => Hash::make('1234'),
            'role' => 'user',
            'created_at' => now(),
            'updated_at'=> now(),
            ],
        ]);

        $faker = FakerFactory::create('ja_JP');

        $shops = Shop::pluck('id')->all();

        $user = User::find(2);

        for ($i = 0; $i < rand(1, 10); $i++) {
            $shop_id = $shops[array_rand($shops)];
            $user->favoriteShops()->syncWithoutDetaching([$shop_id => [
                            'created_at' => now(),
                            'updated_at' => now()]]);
            $user->shopsEvaluated()->syncWithoutDetaching(
                [$shop_id => [
                            'evaluation' => rand(0, 5),
                            'created_at' => now(),
                            'updated_at' => now()]]
            );
            $user->shopsReserved()->syncWithoutDetaching(
                [$shop_id => [
                            'visited_on' => $faker->dateTimeBetween('now', '1week')->format('Y-m-d H:i'),
                            'number_of_visiters' => rand(1, 5),
                            'created_at' => now(),'updated_at' => now()]]
            );
        };

        User::factory()->count(10)->create()->each(function (User $user) use ($shops, $faker) {
            for ($i = 0; $i < rand(1, 30); $i++) {
                $shop_id = $shops[array_rand($shops)];
                $user->favoriteShops()->syncWithoutDetaching(
                    [$shop_id => [
                            'created_at' => now(),
                            'updated_at' => now()]]
                );
                $user->shopsEvaluated()->syncWithoutDetaching(
                    [$shop_id => [
                            'evaluation' => rand(0, 5),
                            'created_at' => now(),
                            'updated_at' => now()]]
                );
                $user->shopsReserved()->syncWithoutDetaching(
                    [$shop_id => [
                            'visited_on' => $faker->dateTimeBetween('now', '1week')->format('Y-m-d H:i'),
                            'number_of_visiters' => rand(1, 5),
                            'created_at' => now(),'updated_at' => now()]]
                );
            }
        });
    }
}
