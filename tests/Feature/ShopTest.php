<?php

namespace Tests\Feature;

use App\Models\Shop;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ShopTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    protected function setUp(): Void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_destroy()
    {
        $this->withoutExceptionHandling();
        $shop_id = Shop::pluck('id')->random();
        $shop = Shop::find($shop_id)->toArray();

        $response = $this->delete('api/shops/'. $shop_id);
        $response->assertNoContent();

        $this->assertDeleted('shops', $shop);
        $this->assertDatabaseMissing('favorites', [
            'shop_id' => $shop_id,
        ]);
        $this->assertDatabaseMissing('reservations', [
            'shop_id' => $shop_id,
        ]);
        $this->assertDatabaseMissing('evaluations', [
            'shop_id' => $shop_id,
        ]);
    }
}
