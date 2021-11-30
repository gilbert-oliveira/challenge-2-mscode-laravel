<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-slot name="logo">
            <img src="{{asset('img/logo-login-2.png')}}" width="300px">
        </x-slot>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.cpf') }}">
            @csrf

            <div class="block">
                <x-jet-label for="cpf" value="{{ __('CPF') }}" />
                <x-jet-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Enviar Link') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
