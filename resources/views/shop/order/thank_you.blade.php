@extends('layouts.app')

@section('content')
    <div class="contianer">
        Dzięki za zamówienie pzdr
        <table class="table">
            <thead>
                <th scope="col">Zdjęcie</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Cena</th>
                <th scope="col">Ilość</th>
            </thead>
            <tbody>
            @foreach ($order->cart->items as $item)
            @php
                $variant = $item->variant;
            @endphp
                <tr>
                    <td scope="col" style="width: 100px"><img style="height: 100px; width: 100px;" src="{{ $variant->main_image }}"></td>
                    <td>{{ $variant->name }}</td>
                    <td>{{ $variant->price }}</td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="float-end">
            <p>{{ $order->total_price }} zł</p>
            <p> + dostawa ({{ $shipment_price }}) zł</p>
            <p class="display-6">Cena całkowita: <span class="text-primary">{{ number_format($order->total_price + $shipment_price,2) }} zł</span></p>
        </div>
    </div>
@endsection

