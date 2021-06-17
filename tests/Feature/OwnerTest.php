<?php

namespace Tests\Feature;

use App\Models\Owner;
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

    public function test_update_password()
    {
        $owner = Owner::factory()->create();
        $this->assertDatabaseHas('owners', [
            'id' => $owner->id
        ]);

        $current_password = 1234;
        $new_password = 12345;

        $judge = Hash::check($current_password, $owner->password);
        $this->assertTrue($judge);

        $payload = [
            'password' => $current_password,
            'new_password' => $new_password
        ];

        $response = $this->put($this->api_url . $owner->id . "/password", $payload);
        $response->assertOk();

        $updated_user = Owner::find($owner->id);
        $result = Hash::check($new_password, $updated_user->password);
        $this->assertTrue($result);
    }
}
