<?php

namespace Tests\Feature;

use App\Models\Owner;
use Database\Seeders\OwnerSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class OwnerTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    protected $api_url = 'api/owners/';

    protected function setUp(): Void
    {
        parent::setUp();

        $this->seed(OwnerSeeder::class);
    }

    public function test_update_password()
    {
        $id = Owner::pluck('id')->random();
        $owner = Owner::find($id);

        $judge = Hash::check(1234, $owner->password);

        $this->assertTrue($judge);

        $payload = [
            'password' => 1234,
            'new_password' => 12345
        ];

        $response = $this->put($this->api_url . $owner->id . "/password", $payload);
        $response->assertOk();

        $update_user = Owner::find($owner->id);
        $bool = Hash::check(12345, $update_user->password);
        $this->assertTrue($bool);
    }
}
