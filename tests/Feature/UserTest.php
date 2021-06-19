<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    protected $api_url = '/api/users/';

    protected function setUp(): Void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('users', 10);
    }

    public function test_index()
    {
        $response = $this->get($this->api_url);

        $response->assertOk()->assertJsonCount(10, 'data')
        ->assertJsonFragment([
            'email' => 'user1@test.com',
            'email' => 'user2@test.com',
        ]);
    }

    public function test_store()
    {
        $this->assertDatabaseMissing('users', [
            'email' => 'user3@test.com'
        ]);

        $test_user_data = [
            'name' => 'ユーザー',
            'email' => 'user3@test.com',
            'password' => 1234,
        ];

        $response = $this->post($this->api_url, $test_user_data);
        $response->assertOk();

        $this->assertDatabaseHas('users', [
            'email' => 'user3@test.com',
        ]);
    }

    public function test_update()
    {
        $user = User::where('email', 'user1@test.com')->first();

        $this->assertNotSame($user->name, 'ユーザー');
        $this->assertNotSame($user->email, 'user3@test.com');

        $payload = [
            'name' => 'ユーザー',
            'email' => 'user3@test.com'
        ];

        $response = $this->put($this->api_url . $user->id, $payload);
        $response->assertOk();

        $updated_user = User::find($user->id);
        $this->assertSame('ユーザー', $updated_user->name);
        $this->assertSame('user3@test.com', $updated_user->email);
    }

    public function test_update_password()
    {
        $user = User::where('email', 'user1@test.com')->first();

        $current_password = 1234;
        $new_password = 12345;

        $judge = Hash::check($current_password, $user->password);
        $this->assertTrue($judge);

        $payload = [
            'password' => $current_password,
            'new_password' => $new_password
        ];

        $response = $this->put($this->api_url . $user->id . "/password", $payload);
        $response->assertOk();

        $update_user = User::find($user->id);
        $bool = Hash::check($new_password, $update_user->password);
        $this->assertTrue($bool);
    }

    public function test_destroy()
    {
        $id = User::pluck('id')->random();
        $user = User::find($id)->toArray();

        $user_key_data = ['user_id' => $user['id']];

        $this->assertDatabaseHas('favorites', $user_key_data);
        $this->assertDatabaseHas('reservations', $user_key_data);
        $this->assertDatabaseHas('evaluations', $user_key_data);

        $response = $this->delete($this->api_url . $user['id']);
        $response->assertNoContent();

        $this->assertDeleted('users', $user);
        $this->assertDatabaseMissing('favorites', $user_key_data);
        $this->assertDatabaseMissing('reservations', $user_key_data);
        $this->assertDatabaseMissing('evaluations', $user_key_data);
    }
}
