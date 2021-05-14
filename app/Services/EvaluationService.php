<?php

namespace App\Services;

class EvaluationService
{
    public static function createAllRating($shops)
    {
        foreach ($shops as $shop) {
            $count = $shop->evaluations->count();
            $shop->evaluation_count = $count;
            $shop->evaluation = self::calculateRating($shop->evaluations, $count);
        }
        return $shops;
    }

    public static function createOneRating($shop)
    {

        $count = $shop->evaluations->count();
        $shop->evaluation_count = $count;
        $shop->evaluation = self::calculateRating($shop->evaluations, $count);
        return $shop;
    }

    public static function calculateRating($evaluations, $count)
    {
        $rating = 0;
        foreach ($evaluations as $evaluation) {
            $rating += $evaluation->evaluation;
        }
        if ($count !== 0) {
            $rating = round($rating / $count, 1);
        }
        return $rating;
    }
}
