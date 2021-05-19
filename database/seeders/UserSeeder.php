<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\User;
use Carbon\Carbon;
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

        // $faker = FakerFactory::create('ja_JP');

        $this->createPivotTable($user);

        User::factory()->count(9)->create()->each(function (User $user) {
            $this->createPivotTable($user);
        });
    }

    public function createPivotTable($user)
    {
        for ($i = 0; $i < rand(1, 50); $i++) {
            [$date, $status] = $this->createVisitsDateAndStatus();

            $shop_id = Shop::pluck('id')->random();

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
                            'visited_on' => $date,
                            'number_of_visiters' => rand(1, 10),
                            'status' => $status,
                            'created_at' => now(),
                            'updated_at' => now()]]
            );
        }
    }

    public function createVisitsDateAndStatus()
    {
        $faker = FakerFactory::create('ja_JP');
        $date = $faker->dateTimeBetween('-1week', '1week')->format('Y-m-d H:i');
        $status = $this->createStatus($faker, $date);
        return [$date, $status];
    }

    public function createStatus($faker, $date)
    {
        $visits_date = new Carbon($date);
        $now = Carbon::now();
        $status = "";
        if ($visits_date->lt($now)) {
            $status = $faker->randomElement(['visited', 'visited' ,'cancelled']);
        } else {
            $status = $faker->randomElement(['reserving', 'reserving', 'cancelled']);
        }
        return $status;
    }
}
