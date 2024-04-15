<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered_with_valid_signature(): void
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        $team = Team::factory()->create();

        $invitation = TeamInvitation::make([
            'email' => $team->id. '@example.com',
            'role' => 'admin',
        ]);

        $invitation->team()->associate($team->id);

        $invitation->save();

        $url = URL::SignedRoute('register', ['invitation' => $invitation->id]);

        $response = $this->get($url);

        $response->assertStatus(200);
    }

    public function test_registration_screen_cannot_be_rendered_without_valid_signature(): void
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        $response = $this->get('/register');

        $response->assertStatus(403);
    }

//    public function test_registration_screen_cannot_be_rendered_if_support_is_disabled(): void
//    {
//        if (Features::enabled(Features::registration())) {
//            $this->markTestSkipped('Registration support is enabled.');
//        }
//
//        $response = $this->get('/register');
//
//        $response->assertStatus(404);
//    }

    public function test_new_users_can_register(): void
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
