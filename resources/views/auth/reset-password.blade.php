<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{asset('img/logo-login-2.png')}}" width="300px">
        </x-slot>

        <x-jet-validation-errors class="mb-4"/>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-jet-label for="cpf" value="{{ __('CPF') }}"/>
                <x-jet-input id="cpf" class="block mt-1 w-full" type="text" name="cpf"
                             :value="old('cpf', $request->cpf)" required autofocus/>
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}"/>
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                             autocomplete="new-password"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                             name="password_confirmation" required autocomplete="new-password"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Reset Password') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
