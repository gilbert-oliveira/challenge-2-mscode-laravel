@component('mail::layout')
{{-- Header --}}
@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        {{ config('app.name') }}
    @endcomponent
@endslot

<h1>
    Olá {{$observation->ticket()->customer()->name}}!
</h1>

<h2>
    Seu ticket recebeu uma nova observação na nossa plataforma.
</h2>

<p>
    <strong>Título:</strong> {{$observation->ticket()->title}}<br>
    <strong>Categoria</strong> {{$observation->ticket()->category()->name}}<br>
</p>

@component('mail::panel')
    <p><strong>Responsável:</strong> {{ $observation->user()->name }}</p>
    <p>{{ $observation->text }}</p>
@endcomponent

<p>
    Acesse o link para visualizar e resgistrar novas observações!
</p>

{{-- Subcopy --}}
@isset($subcopy)
    @slot('subcopy')
        @component('mail::subcopy')
            {{ $subcopy }}
        @endcomponent
    @endslot
@endisset

@component('mail::button', ['url' => route('public.ticket.details', $observation->ticket()->token)])
    Acessar
@endcomponent

Atenciosamente,<br>
{{ config('app.name') }}

{{-- Footer --}}
@slot('footer')
    @component('mail::footer')
        © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
    @endcomponent
@endslot

@endcomponent
