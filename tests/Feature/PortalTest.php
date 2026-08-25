<?php

namespace Tests\Feature;

use App\Models\Species;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortalTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_can_visit_home_and_species_log(): void
    {
        Species::create([
            'slug' => 'oso-andino-1',
            'common_name' => 'Oso andino',
            'scientific_name' => 'Tremarctos ornatus',
            'group' => 'Mamíferos',
        ]);

        $this->get(route('home'))->assertOk()->assertSee('Ecosysgame');
        $this->get(route('species.index'))->assertOk()->assertSee('Oso andino');
        $this->get(route('species.show', 'oso-andino-1'))->assertOk()->assertSee('Tremarctos ornatus');
    }

    public function test_download_center_requires_authentication(): void
    {
        $this->get(route('dashboard'))->assertRedirect(route('login'));
        $this->actingAs(User::factory()->create())
            ->get(route('dashboard'))->assertOk()->assertSee('Descarga disponible próximamente');
    }

    public function test_regular_user_cannot_open_admin_panel(): void
    {
        $this->actingAs(User::factory()->create(['is_admin' => false]))
            ->get(route('admin.dashboard'))->assertForbidden();
    }

    public function test_admin_can_view_accounts_without_passwords(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        User::factory()->create(['email' => 'jugador@example.com']);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertOk()
            ->assertSee('Panel de administración')
            ->assertSee('jugador@example.com')
            ->assertDontSee($admin->password);
    }
}
