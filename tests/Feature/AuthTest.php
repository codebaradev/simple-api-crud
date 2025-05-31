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

        $token = $response->json('token');

        $response->assertStatus(200)
                ->assertJson([
                    'status' => true,
                    'message' => "User Logged In Successfully",
                ]);
    }

    public function testProfile(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/users/login', [
            'email_username' => $user->username,
            'password' => $user->password
        ]);

        $token = $response->json('token');

        $response = $this->get('/api/users/profile', [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'status' => true,
                    'message' => "User Profile Retrieved Successfully",
                    'data' => $user->toArray()
                ]);
    }

    public function testLogout(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/users/login', [
            'email_username' => $user->username,
            'password' => $user->password
        ]);

        $token = $response->json('token');

        $response = $this->delete('/api/users/logout', [
            'email_username' => $user->username,
            'password' => $user->password
        ], [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'status' => true,
                    'message' => "User Logged Out Successfully"
                ]);
    }
}
