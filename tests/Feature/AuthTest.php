<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected $accessToken = null;
    protected $api_url = '/api/users';

    protected function setUp(): Void
    {
        parent::setUp();

        $test_user_data = [
            'name' => 'テストユーザー',
            'email' => 'test@test.com',
            'password' => 1234,
        ];

        $response = $this->post($this->api_url, $test_user_data);

        $response->assertOk();

        $response = $this->post('/api/login/user', [
            'email' => 'test@test.com',
            'password' => 1234,
        ]);
        $response->assertOk();

        $decoded = $response->decodeResponseJson();

        $this->accessToken = $decoded['token'];
    }

    public function test_auth()
    {
        $response = $this->withHeaders([
            'Authorization' => "Bearer {$this->accessToken}"
        ])->get($this->api_url);

        $response->assertOk();
    }

    public function test_unauth()
    {
        $response = $this->get(route('users.index'));

        $response->assertStatus(500);
    }
}
