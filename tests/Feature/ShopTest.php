<?php

namespace Tests\Feature;

use App\Models\Shop;
use App\Models\Evaluation;
use App\Models\Favorite;
use App\Models\Owner;
use App\Models\Reservation;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ShopTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_destroy()
    {
        $owner = Owner::factory()->create();
        $shop = Shop::factory()->create([
            'owner_id' => $owner->id
        ])->toArray();
        $this->assertDatabaseHas('shops', [
            'id' => $shop['id']
        ]);

        $before_owner = Owner::find($owner->id);
        $this->assertSame(1, $before_owner->shop_present);

        $shop_key_data = ['shop_id' => $shop['id']];

        Favorite::factory()->count(5)->create($shop_key_data);
        Reservation::factory()->count(5)->create($shop_key_data);
        Evaluation::factory()->count(5)->create($shop_key_data);

        $this->assertDatabaseHas('favorites', $shop_key_data);
        $this->assertDatabaseHas('reservations', $shop_key_data);
        $this->assertDatabaseHas('evaluations', $shop_key_data);

        $response = $this->delete('api/shops/'. $shop['id']);
        $response->assertNoContent();

        $this->assertDeleted('shops', $shop);
        $this->assertDatabaseMissing('favorites', $shop_key_data);
        $this->assertDatabaseMissing('reservations', $shop_key_data);
        $this->assertDatabaseMissing('evaluations', $shop_key_data);

        $after_owner = Owner::find($owner->id);
        $this->assertSame(0, $after_owner->shop_present);
    }
}
