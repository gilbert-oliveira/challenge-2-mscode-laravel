<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{asset('img/logo-login-2.png')}}" width="300px">
        </x-slot>

        <x-jet-validation-errors class="mb-4"/>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="cpf" value="{{ __('CPF') }}"/>
                <x-jet-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" required
                             autofocus/>
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Senha') }}"/>
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                             autocomplete="current-password"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                       href="{{ route('password.request') }}">
                        {{ __('Esqueceu sua senha?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Login') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
