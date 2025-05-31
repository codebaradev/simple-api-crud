<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testRegister(): void
    {
        $response = $this->post('/api/users/register', [
            'name' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => fake()->password()
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'status' => 'success',
                    'message' => 'User Registered Successfully'
                ]);
    }

    public function testLogin(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/users/login', [
            'email_username' => $user->username,
            'password' => $user->password
        ]);

        $user = User::where('email', $user->email)->orWhere('username', $user->username)->first();

        $response->assertStatus(200)
                ->assertJson([
                    'status' => true,
                    'message' => "User Logged In Successfully",
                    'token' => $user->token
                ]);
    }
}
