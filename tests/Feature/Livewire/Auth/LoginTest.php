<?php

namespace Tests\Feature\Livewire\Auth;

use App\Livewire\Auth\Login;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Login::class)
            ->assertStatus(200);
        
    }

    /** @test */
    public function should_be_login_user() {
        $user = User::factory()->create([
            'email' => 'joe@doe.com',
            'password' => 'password',
        ]);

        Livewire::test(Login::class)
            ->set('email', 'joe@doe.com')
            ->set('password', 'password')
            ->call('tryToLogin')
            ->assertHasNoErrors()
            ->assertRedirect(route('dashboard'));

        expect(auth()->check())->toBeTrue()
            ->and(auth()->user())->id->toBe($user->id);
    }

    /** @test */
    public function message_invalid_credentials()
    {
        Livewire::test(Login::class)
            ->set('email', 'joe@doe.com')
            ->set('password', 'password')
            ->call('tryToLogin')
            ->assertHasErrors(['invalidCredentials'])
            ->assertSee(trans('auth.failed'));
    }

    /** @test */
    public function rate_limit_is_blocked_after_5_attempts()
    {
        $user = User::factory()->create();

        for ($i = 0; $i < 5; $i++) {
            Livewire::test(Login::class)
                ->set('email', $user->email)
                ->set('password', 'wrong-password')
                ->call('tryToLogin')
                ->assertHasErrors(['invalidCredentials']);
        }
    
        Livewire::test(Login::class)
            ->set('email', $user->email)
            ->set('password', 'wrong-password')
            ->call('tryToLogin')
            ->assertHasErrors(['rateLimiter']);
    }
}
