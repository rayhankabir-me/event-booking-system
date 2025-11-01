<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register_with_valid_data()
    {
        $response = $this->postJson('/api/user/register', [
            'name' => 'Rayhan Kabir',
            'email' => 'rayhan5@example.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => 'rayhan5@example.com']);
    }

    /** @test */
    public function registration_fails_with_invalid_data()
    {
        $response = $this->postJson('api/user/register', [
            'email' => 'invalid-email',
            'password' => '123',
        ]);

        $response->assertStatus(422);
    }
}
