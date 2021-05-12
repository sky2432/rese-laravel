<?php

namespace App\Console\Commands;

use App\Models\Evaluation;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'テスト用のコマンド';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('start');

        // $shops = User::find(2)->favoriteShops;

        // foreach ($shops as $shop) {
        //     echo "\n";
        //     echo $shop;
        // }

        // $area = Shop::find(1)->area->name;

        // echo $area;

        $shops = Shop::all();
        // $shops->evaluations;
        // $shops = Shop::with(['area:id,name', 'genre:id,name'])->evaluations()->get();

        foreach ($shops as $shop) {
            // $shop->rating = 5;
            // $shop->evaluations = $shop->evaluations;
            // echo $shop->evaluations()->count();
            $count = $shop->evaluations()->count();
            $shop->evaluation_count = $count;
            $shop->evaluation = $this->createRating($shop->evaluations, $count);
            echo $shop->evaluation;
            echo "\n";

            echo $shop->evaluation_count;
            echo "\n";
        }
        // $shops = Shop::pluck('id')->all();
        // foreach($shops as $shop) {
        //     echo $shop;
        // }

        // $shops = Shop::with(['area:id,name', 'genre:id,name'])->get();


        echo "\n";
        $this->info('end');
    }

    public function createRating($evaluations, $count)
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
