@component('mail::message')
# Witaj

Twoje zamówienie o numerze {{ $order->id }} zostało złożone i oczekuje na potwierdzenie.

Oto dane Twojego zamówienia (tego z numerem {{ $order->id }})

Łączna kwota zamówienia: {{ $order->total_price }}zł (całkiem dużo)

<table style="width: 100%">
    <thead>
        <th>Nazwa</th>
        <th>Cena za sztukę</th>
        <th>Sztuk</th>
        <th>Łącznie</th>
    </thead>
    <tbody>
@foreach ($order->cart->items as $item)
    <tr>
        <td>{{ $item->variant->name }}</td>
        <td>{{ number_format($item->variant->price,2) }}zł</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ number_format($item->variant->price * $item->quantity,2) }}zł</td>
    </tr>
@endforeach
    </tbody>
</table>
@if ($order->cart->coupon)
<br>
    Użyty kod rabatowy - {{ $order->cart->coupon->coupon }}
    {{ $order->cart->coupon->promotion }}% zniżki {{ $order->cart->coupon->shipment == 1 ? ', oraz darmowa dostawa' : '' }}<br>
@endif
<br><br>
Dane odbiorcy:

Imię - {{ $order->first_name }}<br>
Nazwisko - {{ $order->last_name }}<br>
Adres email - {{ $order->mail }}<br>
Numer telefonu - {{ $order->phone }}<br>
Miejscowość - {{ $order->city }}<br>
Adres - {{ $order->address }}<br>
Kod pocztowy - {{ $order->zip }}<br>

@component('mail::button', ['url' => ''])
Przejdź na naszą stronę
@endcomponent

Pzdr 600,<br>
{{ config('app.name') }}
@endcomponent
