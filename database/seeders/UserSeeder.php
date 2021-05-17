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
            'name' => 'そら',
            'email' => 'test1@test.com',
            'password' => Hash::make('1234'),
            'created_at' => now(),
            'updated_at'=> now(),
            ],
        ]);

        $user = User::find(1);

        $shops = Shop::pluck('id')->all();

        $faker = FakerFactory::create('ja_JP');

        $this->createPivotTable($user, $shops, $faker);

        User::factory()->count(9)->create()->each(function (User $user) use ($shops, $faker) {
            $this->createPivotTable($user, $shops, $faker);
        });
    }

    public function createPivotTable($user, $shops, $faker)
    {
        for ($i = 0; $i < rand(1, 30); $i++) {
            $shop_id = $shops[array_rand($shops)];
            $user->favoriteShops()->syncWithoutDetaching(
                [$shop_id => [
                            'created_at' => now(),
                            'updated_at' => now()]]
            );
            $user->shopsEvaluated()->syncWithoutDetaching(
                [$shop_id => [
                            'evaluation' => rand(1, 5),
                            'created_at' => now(),
                            'updated_at' => now()]]
            );
            $user->shopsReserved()->syncWithoutDetaching(
                [$shop_id => [
                            'visited_on' => $faker->dateTimeBetween('now', '1week')->format('Y-m-d H:i'),
                            'number_of_visiters' => rand(1, 5),
                            'created_at' => now(),
                            'updated_at' => now()]]
            );
        }
    }
}
