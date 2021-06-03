<?php

namespace Tests\Feature;

use App\Models\Evaluation;
use App\Models\Favorite;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    protected $api_url = '/api/users/';
    protected $data_count = 2;
    protected $test_email1 = 'test1@test.com';
    protected $test_email2 = 'test2@test.com';
    protected $test_email3 = 'test3@test.com';
    protected $test_name = 'テストユーザー';
    protected $user;


    protected function setUp(): Void
    {
        parent::setUp();

        $users = User::factory()->count($this->data_count)->state(new Sequence(
            ['email' => $this->test_email1],
            ['email' => $this->test_email2],
        ))->create([
            'name' => 'ユーザー'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $this->test_email1,
            'email' => $this->test_email2,
        ]);
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
        $this->assertDatabaseMissing('users', [
            'email' => $this->test_email3
        ]);

        $test_user_data = [
            'name' => $this->test_name,
            'email' => $this->test_email3,
            'password' => 1234,
        ];

        $response = $this->post($this->api_url, $test_user_data);
        $response->assertOk();

        $this->assertDatabaseHas('users', [
            'email' => $this->test_email3,
        ]);
    }

    public function test_update()
    {
        $user = User::where('email', $this->test_email1)->first();

        $this->assertNotSame($user->name, $this->test_name);
        $this->assertNotSame($user->email, $this->test_email3);

        $payload = [
            'name' => $this->test_name,
            'email' => $this->test_email3
        ];

        $response = $this->put($this->api_url . $user->id, $payload);
        $response->assertOk();

        $updated_user = User::find($user->id);
        $this->assertSame($this->test_name, $updated_user->name);
        $this->assertSame($this->test_email3, $updated_user->email);
    }

    public function test_update_password()
    {
        $user = User::where('email', $this->test_email1)->first();

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
        $user = User::where('email', $this->test_email1)->first()->toArray();

        $user_key_data = ['user_id' => $user['id']];

        Favorite::factory()->count(5)->create($user_key_data);
        Reservation::factory()->count(5)->create($user_key_data);
        Evaluation::factory()->count(5)->create($user_key_data);

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
