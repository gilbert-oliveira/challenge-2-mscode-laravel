@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot
    <h1>
        Olá {{$user->name}}!
    </h1>
    <p>
        Seu cadastro foi realizado na nossa plataforma de suporte.
        Para realizar o acesso utilize as credenciais abaixo:
    </p>
    <p>
        Seu usuário é: <strong>{{ $user->cpf }}</strong>
        <br>
        Sua senha é: <strong>{{$password}}</strong>
    </p>
    <p>
        Acesse o link abaixo para acessar o sistema.
    </p>
    @component('mail::button', ['url' => route('login')])
        Faça login
    @endcomponent

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
