<?php

use App\Livewire\Auth\Register;
use App\Models\User;
use App\Notifications\WelcomeNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Register::class)
        ->assertStatus(200);
});

it('should be able to register a new user in the system', function () {
    Livewire::test(Register::class)
        ->set('name', 'Joe Doe')
        ->set('email', 'joe@doe.com')
        ->set('email_confirmation', 'joe@doe.com')
        ->set('password', 'password')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertRedirect(RouteServiceProvider::HOME);

    $this->assertDatabaseHas( 'users', [
        'name' => 'Joe Doe',
        'email' => 'joe@doe.com',
    ]);

    $this->assertDatabaseCount('users', 1);

    $this->expect(auth()->check())
        ->and(auth()->user())
        ->id->toBe(User::first()->id);
});

test('required fields', function ($field) {
    Livewire::test(Register::class)
        ->set($field, '')
        ->call('submit')
        ->assertHasErrors([$field => 'required']);
})->with(['name', 'email', 'password']);

it('notification new user', function () {
    Notification::fake();

    Livewire::test(Register::class)
    ->set('name', 'Joe Doe')
    ->set('email', 'joe@doe.com')
    ->set('email_confirmation', 'joe@doe.com')
    ->set('password', 'password')
    ->call('submit');

    $user = User::whereEmail('joe@doe.com')->first();

    Notification::assertSentTo($user, WelcomeNotification::class);
});