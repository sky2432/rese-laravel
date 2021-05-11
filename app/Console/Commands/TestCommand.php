<?php

namespace App\Console\Commands;

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

        $area = Shop::find(1)->area->name;

        echo $area;


        // $shops = Shop::pluck('id')->all();
        // foreach($shops as $shop) {
        //     echo $shop;
        // }

        // $shops = Shop::with(['area:id,name', 'genre:id,name'])->get();
        // foreach ($shops as $shop) {
        //     echo $shop;
        //     echo "\n";
        // }

        echo "\n";
        $this->info('end');
    }
}
