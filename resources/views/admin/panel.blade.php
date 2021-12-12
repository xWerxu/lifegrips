@extends('layouts.admin')

@section('content')
    <h1 class="display-1">Witaj w Lifegrips, {{ Auth::user()->first_name ? Auth::user()->first_name : Auth::user()->email}}</h1>
    <h3 class="display-6">Oto aktualne podsumowanie:</h3>

    <pre>
        @php
            print_r($array);
        @endphp
        {{-- @foreach ($many as $m)
            @foreach ($m->filterVariant as $f)
                @php
                    print_r($f->value);
                @endphp
            @endforeach
        @endforeach
        @foreach ($test as $manytomany)
            @php
                print_r($manytomany->variant->name);
            @endphp
        @endforeach --}}
    </pre>

    <div class="row mt-5">
        <div class="col-6">
            <div class="card text-center">
                <div class="card text-center align-middle">
                    <h2 class="mt-3">Wszystkich złożonych zamówień</h2>
                    <h3 class="text-primary fw-bold mt-3">{{ $all_orders }}</h6>
                    <div class="progress m-3">
                        <div class="progress-bar" style="width: {{ $all_orders/100*100 }}%" role="progressbar" aria-valuenow="{{ $all_orders }}" aria-valuemin="0" aria-valuemax="10"></div>
                    </div>
                    <hr class="mt-3">
                    <h2 class="mt-3">Zamówień złożonych w tym miesiącu</h2>
                    <h3 class="text-success fw-bold mt-3">{{ $this_month }}</h6>
                    <div class="progress m-3">
                        <div class="progress-bar bg-success" style="width: {{ $this_month/10*100 }}%" role="progressbar" aria-valuenow="{{ $this_month }}" aria-valuemin="0" aria-valuemax="10"></div>
                    </div>
                    <hr class="mt-3">
                    <h2 class="mt-3">Zamówień oczekujących na potwierdzenie</h2>
                    <h3 class="text-danger fw-bold mt-3">{{ count($waiting_orders) }}</h6>
                    <div class="progress m-3">
                        <div class="progress-bar bg-danger" style="width: {{ count($waiting_orders)/10*100 }}%" role="progressbar" aria-valuenow="{{ count($waiting_orders) }}" aria-valuemin="0" aria-valuemax="10"></div>
                    </div>
                </div>
            </div>
            <div class="card text-center mt-4">
                <h2>Zamówienia oczekujące na potwierdzenie</h2>
                @if (count($waiting_orders) == 0)
                    <p>Brak oczekujących zamówień - jesteśmy na bieżąco!</p>
                @else
                    <table class="table">
                        <thead>
                            <th scope="col">Nr zamówienia</td>
                            <th scope="col">Email</td>
                            <th scope="col">Kwota</th>
                            <th scope="col">Złożone</td>
                            <th scope="col">Szczegóły</td>
                        </thead>
                        <tbody>
                            @foreach ($waiting_orders as $order)
                                <tr>
                                    <td scope="row">{{ $order->id }}</td>
                                    <td>{{ $order->mail }}</td>
                                    <td>{{ number_format($order->total_price, 2) }} zł</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.order.edit', ['id' => $order->id]) }}" class="btn btn-warning"><i class="me-2 bi bi-pencil"></i>Przetwórz</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="card text-center">
                <h2>Ostatnie zamówienia</h2>
                <table class="table">
                    <thead>
                        <th scope="col">Nr zamówienia</td>
                        <th scope="col">Status</td>
                        <th scope="col">Kwota</th>
                        <th scope="col">Złożone</td>
                        <th scope="col">Szczegóły</td>
                    </thead>
                    <tbody>
                        @foreach ($last_orders as $order)
                            <tr>
                                <td scope="row">{{ $order->id }}</td>
                                <td>
                                    @if ($order->status == 0)
                                        <span class="badge rounded-pill bg-secondary"><i class="bi bi-hourglass me-2"></i>Oczekuje</span>
                                    @elseif ($order->status == 1)
                                        <span class="badge rounded-pill bg-success"><i class="bi bi-check-lg me-2"></i>Zatwierdzone</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger"><i class="bi bi-x-lg me-2"></i>Anulowane</span>
                                    @endif
                                </td>
                                <td>{{ number_format($order->total_price, 2) }} zł</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
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
            <div class="card text-center mt-4">
                <h2>Najnowsi klienci</h2>
                <table class="table">
                    <thead>
                        <th scope="col">ID</td>
                        <th scope="col">Email</td>
                        <th scope="col">Potwierdzony</td>
                        <th scope="col">Szczegóły</td>
                    </thead>
                    <tbody>
                        @foreach ($last_customers as $customer)
                            <tr>
                                <td scope="row">{{ $customer->id }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>
                                    @if ($customer->verified_at)
                                    <span class="badge rounded-pill bg-success"><i class="bi bi-check-lg me-2"></i>Tak</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger"><i class="bi bi-x-lg me-2"></i>Nie</span>
                                    @endif
                                <td>
                                    <a href="{{ route('admin.customer.show', ['id' => $customer->id]) }}" class="btn btn-primary"><i class="me-2 bi bi-search"></i>Sprawdź</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection