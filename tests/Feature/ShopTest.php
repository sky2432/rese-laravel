<?php

namespace Tests\Feature;

use App\Models\Shop;
use App\Models\Evaluation;
use App\Models\Favorite;
use App\Models\Owner;
use App\Models\Reservation;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Database\Seeders\DatabaseSeeder;

class ShopTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_destroy()
    {
        $this->seed(DatabaseSeeder::class);

        $owner = Owner::where('is_shop', 1)->first();
        $shop = Shop::where('owner_id', $owner->id)->first()->toArray();

        $this->assertSame(1, $owner->is_shop);

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
        $this->assertSame(0, $after_owner->is_shop);
    }
}
