<?php

namespace Tests\Feature;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_change_status()
    {
        DB::table('reservations')->insert([
                'user_id' => 1,
                'shop_id' => 1,
                'visited_on' => Carbon::now()->format('Y-m-d H:i:00'),
                'number_of_visiters' => 2,
                'status' => 'reserving'
        ]);

        $this->assertDatabaseCount('reservations', 1);

        $reservation = Reservation::first();
        $this->assertSame('reserving', $reservation->status);

        $this->artisan('command:change_status');

        $reservation = Reservation::find($reservation->id);
        $this->assertSame('visited', $reservation->status);
    }
}
