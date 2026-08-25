<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_register_with_a_hashed_password(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Usuario Seguro',
            'email' => 'seguro@example.com',
            'password' => 'Segura#2026',
            'password_confirmation' => 'Segura#2026',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('status', 'Cuenta creada correctamente. Ya puedes iniciar sesión.');
        $this->assertGuest();

        $user = User::where('email', 'seguro@example.com')->firstOrFail();
        $this->assertNotSame('Segura#2026', $user->password);
        $this->assertTrue(Hash::check('Segura#2026', $user->password));
    }

    public function test_registration_is_validated_on_the_server(): void
    {
        $response = $this->from(route('register'))->post(route('register.store'), [
            'name' => '',
            'email' => 'correo-invalido',
            'password' => '123',
            'password_confirmation' => '456',
        ]);

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors(['name', 'email', 'password']);
        $this->assertGuest();
    }

    public function test_user_can_log_in_and_access_the_dashboard(): void
    {
        $user = User::factory()->create([
            'email' => 'login@example.com',
            'password' => Hash::make('Segura#2026'),
        ]);

        $response = $this->post(route('login.store'), [
            'email' => 'login@example.com',
            'password' => 'Segura#2026',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
        $this->get(route('dashboard'))->assertOk()->assertSee($user->name);
    }

    public function test_invalid_credentials_show_a_generic_error(): void
    {
        User::factory()->create([
            'email' => 'login@example.com',
            'password' => Hash::make('Segura#2026'),
        ]);

        $response = $this->from(route('login'))->post(route('login.store'), [
            'email' => 'login@example.com',
            'password' => 'Incorrecta#2026',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors([
            'email' => 'Las credenciales proporcionadas no son válidas.',
        ]);
        $this->assertGuest();
    }

    public function test_dashboard_requires_authentication(): void
    {
        $this->get(route('dashboard'))->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_log_out_safely(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertGuest();
        $this->get(route('dashboard'))->assertRedirect(route('login'));
    }

    public function test_login_is_rate_limited_after_five_attempts(): void
    {
        for ($attempt = 1; $attempt <= 5; $attempt++) {
            $this->post(route('login.store'), [
                'email' => 'throttle@example.com',
                'password' => 'Incorrecta#2026',
            ])->assertRedirect();
        }

        $this->post(route('login.store'), [
            'email' => 'throttle@example.com',
            'password' => 'Incorrecta#2026',
        ])->assertStatus(429)->assertSee('Demasiados intentos');
    }
}
