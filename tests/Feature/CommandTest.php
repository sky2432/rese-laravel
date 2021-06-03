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
        $reservation = Reservation::factory()->create([
            'visited_on' => Carbon::now()->format('Y-m-d H:i:00'),
            'status' => 'reserving'
        ]);

        $this->assertDatabaseHas('reservations', [
            'id' => $reservation->id
        ]);

        $this->assertSame('reserving', $reservation->status);

        $this->artisan('command:change_status');

        $reservation = Reservation::find($reservation->id);
        $this->assertSame('visited', $reservation->status);
    }
}
