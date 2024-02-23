<?php

use App\Livewire\Auth\Register;
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
        ->assertHasNoErrors();
});

it('has user')->assertDatabaseHas( 'users', [
    'name' => 'Joe Doe',
    'email' => 'joe@doe.com',
]);

it('unique user')->assertDatabaseCount('users', 1);