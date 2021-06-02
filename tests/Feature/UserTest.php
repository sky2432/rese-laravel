<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    protected $api_url = '/api/users';
    protected $user_id;
    protected $data_count = 2;

    protected function setUp(): Void
    {
        parent::setUp();

        User::factory()->count($this->data_count)->state(new Sequence(
            ['email' => 'test1@test.com'],
            ['email' => 'test2@test.com'],
        ))->create();

        $this->assertDatabaseCount('users', $this->data_count);

        $this->user_id = User::pluck('id')->random();
    }

    public function test_store()
    {
        $test_user_data = [
            'name' => 'TestUser',
            'email' => 'test@test.com',
            'password' => 1234,
        ];

        $response = $this->post($this->api_url, $test_user_data);

        $response->assertOk()->assertJsonFragment([
            'email' => 'test@test.com',
        ]);
    }

    public function test_index()
    {
        $response = $this->get($this->api_url);

        $response->assertOk()->assertJsonCount($this->data_count, 'data')
        ->assertJsonFragment([
            'email' => 'test1@test.com',
            'email' => 'test2@test.com'
        ]);
    }

    public function test_update()
    {
        $payload = [
            'name' => 'TestUser',
            'email' => 'test10@test.com'
        ];

        $response = $this->put("api/users/" . $this->user_id, $payload);

        $response->assertOk()->assertJsonFragment([
            'email' => 'test10@test.com'
        ]);
    }

    public function test_destroy()
    {
        $user = User::find($this->user_id)->toArray();

        $response = $this->delete("api/users/" . $this->user_id);

        $response->assertNoContent();
        $this->assertDeleted('users', $user);
    }
}
