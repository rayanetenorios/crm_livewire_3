<?php

namespace Tests\Feature\Auth;

use App\Livewire\Auth\Logout;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

use function Pest\Laravel\actingAs;

class LogoutTest extends TestCase
{
    /** @test */
    public function logout_application()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        Livewire::test(Logout::class)
            ->call('logout')
            ->assertRedirect(route('login'));

        expect(auth())
            ->guest()
            ->toBeTrue();
    }
}