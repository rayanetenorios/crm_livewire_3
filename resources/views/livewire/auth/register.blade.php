<x-card shadow class="mx-auto max-w-[400px] w-full">
    <x-form wire:submit="submit">
        <x-input label="{{ __('Name') }}" wire:model="name" />
        <x-input label="{{ __('E-Mail Address') }}" wire:model="email" />
        <x-input label="{{ __('Confirm your e-mail') }}" wire:model="email_confirmation" />
        <x-input label="{{ __('Password') }}" wire:model="password" type="password" />
     
        <x-slot:actions>
            <x-button label="{{ __('Reset') }}" type="reset" />
            <x-button label="{{ __('Register') }}" class="btn-primary" type="submit" spinner="submit" />
        </x-slot:actions>
    </x-form>
</x-card>
