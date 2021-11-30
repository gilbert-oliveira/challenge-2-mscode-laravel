@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
    {{ config('app.name') }}
@endcomponent
@endslot

<h1>
Olá {{$ticket->customer()->name}}!
</h1>
<p>
    Seu ticket foi aberto na nossa plataforma.
    <br>
    Acesse o link para visualizar e resgistrar novas observações!
</p>
@component('mail::button', ['url' => route('public.ticket.details', $ticket->token)])
    Acessar
@endcomponent

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
    @component('mail::subcopy')
        {{ $subcopy }}
    @endcomponent
@endslot
@endisset

Atenciosamente,<br>
{{ config('app.name') }}

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
    © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot

@endcomponent
