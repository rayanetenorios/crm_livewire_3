<?php

namespace App\Livewire\Auth;

use App\Models\User;
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
        return view('livewire.auth.register');
    }

    public function rules()
    {
        return [
            'name' => ['required', ' max:255'],
            'email' => 'required',
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

        $this->redirect(RouteServiceProvider::HOME);
    }
}
