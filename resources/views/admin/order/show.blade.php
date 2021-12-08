@extends('layouts.admin')

@section('content')
<div class="d-block">
    <h1 class="float-start"><i class="me-2 bi bi-pencil"></i>Zamówienie nr. {{ $order->id }}</h1>
    @if ($order->status == 1)
        <span class="text-success float-end display-6"><i class="bi bi-check-lg"></i>Zatwierdzone</span>
    @else
        <div class="text-danger float-end display-6"><i class="bi bi-x-lg me-2"></i>Anulowane</div>
    @endif
</div>
<br><br>
<hr class="d-block">
@if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
@endif
<div class="card">
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="container">
                <h2 class="mt-3">Zamówione produkty</h2>
                <hr>
                @if (session('quantityError'))
                    <div class="alert alert-danger">
                        {{ session('quantityError') }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Zdjęcie</th>
                            <th scope="col">Nazwa</th>
                            <th scope="col">Cena/szt</th>
                            <th scope="col">Zamówiono</th>
                            <th scope="col">Sztuk w magazynie</th>
                            <th scope="col">Łączna cena</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->cart->items as $item)
                        @php
                            $variant = $item->variant;
                        @endphp
                        <tr class="text-center">
                            <td scope="col" class="align-middle" style="width: 100px"><img class="m-0" src="{{ $variant->main_image }}" style="height: 100px; width: 100px;"></td>
                            <td class="align-middle text-break w-25">{{ $variant->name }}</td>
                            <td class="align-middle">{{ $variant->price }} zł</td>
                            <td class="align-middle">{{ $item->quantity }}</td>
                            <td class="align-middle">{{ $variant->on_stock }}</td>
                            <td class="align-middle">{{ $variant->price * $item->quantity }} zł</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <h1 class="float-end"><span class="display-6">Łączna kwota zamówienia:</span> <span class="text-primary">{{ $order->total_price }} zł</span></h1>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="row">
                <h2 class="mt-3">Dane zamówienia</h2>
                <hr>
                <h4>Imię i nazwisko:</h4>
                <p>{{ $order->first_name . ' ' . $order->last_name }}</p>
                <h4>E-mail</h4>
                <p>{{ $order->mail }}</p>
                <h4>Numer telefonu</h4>
                <p>{{ $order->phone }}</p>
                <h4>Miejscowość</h4>
                <p>{{ $order->city }}</p>
                <h4>Adres zamieszkania</h4>
                <p>{{ $order->address }}</p>
                <h4>Kod pocztowy</h4>
                <p>{{ $order->zip }}</p>
                <h4>Metoda dostawy</h4>
                <p>{{ $order->shipment->name }}</p>
                <h4>Metoda płatności</h4>
                <p>{{ $order->payment->name }}</p>
                @if ($order->cart->coupon_id)
                    @php
                        $coupon = $order->cart->coupon;
                    @endphp
                    <h4>Użyty kod rabatowy</h4>
                    <p>{{ $coupon->coupon }} ({{ $coupon->promotion }}% rabatu, {{ $coupon->shipment == 1 ? 'darmowa dostawa' : ''}})</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection