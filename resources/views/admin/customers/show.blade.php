@extends('layouts.admin')

@section('content')
<div class="d-block">
    <h1 class="float-start"><i class="bi bi-list-ul me-2"></i>Klient {{ $customer->id }}</h1>
</div>
<br><br>
<hr class="d-block">
<div class="card">
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="container">
                <h2 class="mt-3">Zamówienia klienta</h2>
                <hr>
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID zamówienia</th>
                            <th scope="col">Łączna kwota (zł)</th>
                            <th scope="col">Zamówiono</th>
                            <th scope="col">Zatwierdzone</th>
                            <th scope="col">Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="align-middle text-center">
                                <td scope="row">{{ $order->id }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->completed_date == null ? 'Nie' : $order->completed_date }}</td>
                                <td class="align-middle">
                                    <div class="btn-group">
                                        @if ($order->status == 0)
                                        <a href="{{ route('admin.order.edit', ['id' => $order->id]) }}" class="btn btn-warning"><i class="me-2 bi bi-pencil"></i>Przetwórz</a>
                                        @else
                                        <a href="{{ route('admin.order.edit', ['id' => $order->id]) }}" class="btn btn-primary"><i class="me-2 bi bi-search"></i>Sprawdź</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <h2 class="mt-3">Dane klienta</h2>
            <hr>
            <h4>E-mail</h4>
            <p>{{ $customer->email }}</p>
            <h4>Imię i nazwisko:</h4>
            @if ($customer->first_name && $customer->last_name)
                <p>{{ $customer->first_name . ' ' . $customer->last_name }}</p>
            @else
                <p>Nie podano</p>
            @endif
            <h4>Numer telefonu</h4>
            <p>{{ $customer->phone ? $customer->phone : 'Nie podano'}}</p>
            <h4>Miejscowość</h4>
            <p>{{ $customer->city ? $customer->city : 'Nie podano' }}</p>
            <h4>Adres zamieszkania</h4>
            <p>{{ $customer->address ? $customer->address : 'Nie podano'}}</p>
            <h4>Kod pocztowy</h4>
            <p>{{ $customer->postal_code ? $customer->postal_code : 'Nie podano' }}</p>
        </div>
    </div>
</div>
@endsection