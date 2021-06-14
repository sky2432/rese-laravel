<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use App\Notifications\RemindNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemindMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:remind_mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'リマインドメールを送信します';

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

        //テスト用のコードのためコメントアウトして残している↓
        // Carbon::setTestNow('2021-05-01 00:00:00');

        $now = Carbon::now();
        $addDay = $now->copy()->addDay()->format('Y-m-d H:i:00');

        $items = Reservation::where('visited_on', $addDay)->get();

        foreach ($items as $item) {
            $user = $item->user;
            $shop = $item->shop;
            $user->notify(new RemindNotification($item, $shop));
        }

        echo "\n";
        $this->info('end');
    }
}
