<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApiAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_creates_a_non_admin_user_with_hashed_password(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Jugador API',
            'email' => 'api@example.com',
            'password' => 'Segura#2026',
            'password_confirmation' => 'Segura#2026',
            'is_admin' => true,
        ]);

        $response->assertCreated()
            ->assertJsonPath('user.email', 'api@example.com')
            ->assertJsonMissingPath('user.password')
            ->assertJsonMissingPath('user.is_admin');

        $user = User::where('email', 'api@example.com')->firstOrFail();
        $this->assertFalse($user->is_admin);
        $this->assertTrue(Hash::check('Segura#2026', $user->password));
        $this->assertGuest();
    }

    public function test_register_returns_json_validation_errors(): void
    {
        $this->postJson('/api/register', [
            'name' => '',
            'email' => 'correo-invalido',
            'password' => '123',
            'password_confirmation' => '456',
        ])->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    public function test_login_returns_a_bearer_token(): void
    {
        User::factory()->create([
            'email' => 'login-api@example.com',
            'password' => Hash::make('Segura#2026'),
        ]);

        $this->postJson('/api/login', [
            'email' => 'login-api@example.com',
            'password' => 'Segura#2026',
        ])->assertOk()
            ->assertJsonPath('token_type', 'Bearer')
            ->assertJsonStructure(['token', 'user' => ['id', 'name', 'email']]);
    }

    public function test_login_rejects_invalid_credentials(): void
    {
        $this->postJson('/api/login', [
            'email' => 'missing@example.com',
            'password' => 'Incorrecta#2026',
        ])->assertUnauthorized()
            ->assertJsonPath('message', 'Las credenciales proporcionadas no son válidas.');
    }

    public function test_profile_requires_a_valid_token(): void
    {
        $this->getJson('/api/profile')->assertUnauthorized();

        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $this->withToken($token)->getJson('/api/profile')
            ->assertOk()
            ->assertJsonPath('user.email', $user->email)
            ->assertJsonMissingPath('user.password');
    }

    public function test_logout_revokes_the_current_token(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $this->withToken($token)->postJson('/api/logout')
            ->assertOk()
            ->assertJsonPath('message', 'Sesión cerrada y token revocado correctamente.');

        $this->assertDatabaseCount('personal_access_tokens', 0);
        $this->app['auth']->forgetGuards();

        $this->withToken($token)->getJson('/api/profile')->assertUnauthorized();
    }
}
