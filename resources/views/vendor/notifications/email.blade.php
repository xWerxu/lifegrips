@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Witaj!')
@endif
@endif

{{-- Intro Lines --}}
Prosimy o potwierdzenie adresu email


{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
Potwierdź adres email
@endcomponent
@endisset

{{-- Outro Lines --}}
Jeśli to nie Ty utworzyłeś konto w naszym serwisie, nie musisz nic robić.
{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Pzdr 600, <br>
{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "Jeśli miałeś problem z kliknięciem przycisku \":actionText\" , skopiuj poniższy link\n".
    'i wklej go do przeglądarki:',
    [
        'actionText' => 'Potwierdź adres email',
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
