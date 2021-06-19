<?php

namespace Tests\Feature;

use App\Models\Reservation;
use App\Models\Shop;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Database\Seeders\DatabaseSeeder;
use Tests\TestCase;

class CommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_change_status()
    {
        $this->seed(DatabaseSeeder::class);

        $reservation = Reservation::factory()->create([
            'user_id' => User::pluck('id')->random(),
            'shop_id' => Shop::pluck('id')->random(),
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
