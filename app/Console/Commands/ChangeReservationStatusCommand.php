<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ChangeReservationStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:change_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '予約のステータスを来店済みにします';

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
        // Carbon::setTestNow('2021-05-17 10:30:00');

        $now = Carbon::now()->format('Y-m-d H:i:00');

        $reservations = Reservation::where('status', 'reserving')->where('visited_on', $now)->get();

        foreach($reservations as $reservation) {
            $reservation->status = 'visited';
            $reservation->save();
        }

        echo "\n";
        $this->info('end');
    }
}
