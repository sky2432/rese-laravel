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
    protected $test_email1 = 'test1@test.com';
    protected $test_email2 = 'test2@test.com';
    protected $test_email3 = 'test3@test.com';
    protected $test_name = 'TestUser';


    protected function setUp(): Void
    {
        parent::setUp();

        User::factory()->count($this->data_count)->state(new Sequence(
            ['email' => $this->test_email1],
            ['email' => $this->test_email2],
        ))->create();

        $this->assertDatabaseCount('users', $this->data_count);

        $this->user_id = User::pluck('id')->random();
    }

    public function test_index()
    {
        $response = $this->get($this->api_url);

        $response->assertOk()->assertJsonCount($this->data_count, 'data')
        ->assertJsonFragment([
            'email' => $this->test_email1,
            'email' => $this->test_email2
        ]);
    }

    public function test_store()
    {
        $test_user_data = [
            'name' => $this->test_name,
            'email' => $this->test_email3,
            'password' => 1234,
        ];

        $response = $this->post($this->api_url, $test_user_data);

        $response->assertOk()->assertJsonFragment([
            'email' => $this->test_email3,
        ]);
    }

    public function test_update()
    {
        $payload = [
            'name' => $this->test_name,
            'email' => $this->test_email3
        ];

        $response = $this->put("api/users/" . $this->user_id, $payload);

        $response->assertOk()->assertJsonFragment([
            'email' => $this->test_email3
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
