<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Notifications\WelcomeNotification;
use App\Providers\RouteServiceProvider;
use Livewire\Component;

class Register extends Component
{
    public ?string $name = null;
    public ?string $email = null;
    public ?string $email_confirmation = null;
    public ?string $password = null;

    public function render()
    {
        return view('livewire.auth.register')
            ->layout('components.layouts.guest');
    }

    public function rules()
    {
        return [
            'name' => ['required', ' max:255'],
            'email' => ['required', 'unique:users,email'],
            'password' => 'required',
        ];
    }

    public function submit(): void
    {
        $this->validate();

        $user = User::query()->create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        auth()->login($user);

        $user->notify(new WelcomeNotification());

        $this->redirect(RouteServiceProvider::HOME);
    }
}
