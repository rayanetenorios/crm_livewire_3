<x-card title="{{__('Login')}}" shadow class="mx-auto max-w-[400px] w-full">

    @if($errors->hasAny(['invalidCredentials', 'rateLimiter']))
        <x-alert icon="o-exclamation-triangle" class="alert-warning mb-4">
            @error('invalidCredentials')
            <span>{{ $message }}</span>
            @enderror

            @error('rateLimiter')
            <span>{{ $message }}</span>
            @enderror
        </x-alert>
    @endif

    <x-form wire:submit="tryToLogin">
        <x-input label="{{ __('E-Mail Address') }}" wire:model="email"/>
        <x-input label="{{ __('Password') }}" wire:model="password" type="password"/>
        <x-slot:actions>
            <div class="w-full flex items-center justify-between">
                <a wire:navigate href="{{ route('auth.register') }}" class="link link-primary">
                    {{ __('I want to create an account') }}
                </a>
                <div>
                    <x-button label="{{__('Reset')}}" class="btn-primary" type="reset"/>
                    <x-button label="{{__('Login')}}" class="btn-primary" type="submit" spinner="tryToLogin"/>
                </div>
            </div>
        </x-slot:actions>
    </x-form>
</x-card>