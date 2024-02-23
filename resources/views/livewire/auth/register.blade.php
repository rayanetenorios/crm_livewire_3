<x-card shadow class="mx-auto max-w-[350px] w-full">
    <x-form wire:submit="submit">
        <x-input label="Name" wire:model="name" />
        <x-input label="E-mail" wire:model="email" />
        <x-input label="Confirm your e-mail" wire:model="email_confirmation" />
        <x-input label="Password" wire:model="password" type="password" />
     
        <x-slot:actions>
            <x-button label="Reset" type="reset" />
            <x-button label="Register" class="btn-primary" type="submit" spinner="submit" />
        </x-slot:actions>
    </x-form>
</x-card>
