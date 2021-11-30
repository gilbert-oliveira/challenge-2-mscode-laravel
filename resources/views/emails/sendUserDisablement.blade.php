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
        Sua conta foi <strong>desativada</strong> da nossa plataforma de suporte e você perdeu acesso ao sistema.
    </p>
    <p>
        Para maiores informações, <a href="mailto:support@gilbert.dev.br?subject=Minha conta foi desabilitada"><strong>entre
                em contato com o administrador
                do sistema respondendo esse email!</strong></a>
    </p>

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
