<?php

namespace App\Services;

use App\Models\Shop;
use Carbon\Carbon;
use Faker\Factory as FakerFactory;

class UserSeederService
{
    public static function createPivotTable($user)
    {
        for ($i = 0; $i < rand(10, 50); $i++) {
            [$visits_date, $status] = self::createVisitsDateAndStatus();

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
                            'visited_on' => $visits_date,
                            'number_of_visiters' => rand(1, 5),
                            'status' => $status,
                            'created_at' => now(),
                            'updated_at' => now()]]
            );
        }
    }

    //10:00〜23:30の間で30分おきの来店日時を作成
    public static function createVisitsDateAndStatus()
    {
        $faker = FakerFactory::create('ja_JP');
        $random_date = $faker->dateTimeBetween('-1week', '1week')->format('Y-m-d H:i');
        $date = new Carbon($random_date);
        $minute = $faker->randomElement([0, 30]);
        $hour = "";
        if ($date->hour < 10) {
            $hour = rand(10, 23);
        } else {
            $hour = $date->hour;
        }
        $formatDate = Carbon::create($date->year, $date->month, $date->day, $hour, $minute);
        $status = self::createStatus($formatDate);
        return [$formatDate, $status];
    }

    //来店日時が現在時刻よりも前だった場合、予約状況をvisitedかcancelledにする
    //来店日時が現在時刻よりも後だった場合、予約状況をreservingかcancelledにする
    public static function createStatus($formatDate)
    {
        $faker = FakerFactory::create('ja_JP');
        $now = Carbon::now();
        $status = "";
        if ($formatDate->lt($now)) {
            $status = $faker->randomElement(['visited', 'visited', 'visited', 'cancelled']);
        } else {
            $status = $faker->randomElement(['reserving', 'reserving', 'cancelled']);
        }
        return $status;
    }
}
