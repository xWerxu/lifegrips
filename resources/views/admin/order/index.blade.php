@extends('layouts.admin')

@section('content')
<div class="d-block">
    <h1 class="float-start"><i class="bi bi-list-ul me-2"></i>Zamówienia</h1>
</div>
<br><br>
<hr class="d-block">
@if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
@elseif (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
@endif
@if ($pages > 1)
<ul class="pagination float-start">
    @if ($current_page > 1)
    <li class="page-item" href="#" aria-label="Poprzednia">
        <a href="{{ url()->current() }}?page={{ $current_page - 1 }}&limit={{ $current_limit }}" class="page-link">Poprzednia</a>
    </li>
    @endif
    @for ($i=1; $i<=$pages; $i++)
        <li class="page-item
        @if ($i == $current_page)
            active
        @endif
        "
        >
            <a href="{{ url()->current() }}?page={{ $i }}&limit={{ $current_limit }}" class="page-link">{{ $i }}</a>
        </li>
    @endfor
    @if ($current_page < $pages)
    <li class="page-item" aria-label="Poprzednia">
        <a href="{{ url()->current() }}?page={{ $current_page + 1 }}&limit={{ $current_limit }}" class="page-link">Następna</a>
    </li>
    @endif
</ul>
@endif
<ul class="pagination float-end">
    @foreach ($limits as $limit)
        <li class="page-item
        @if ($limit == $current_limit || $limit == 25)
            active
        @endif
        ">
            <a href="{{ url()->current() }}?page={{ $current_page }}&limit={{ $limit }}" class="page-link">{{ $limit }}</a>
        </li>
    @endforeach
</ul>
<table class="table" id="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Klient</th>
            <th scope="col">Cena zamówienia (zł)</th>
            <th scope="col">Status</th>
            <th scope="col">Utworzone</th>
            <th scope="col">Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td class="align-middle" scope="row"> {{ $order->id }}</td>
            <td class="align-middle">
                @if ($order->cart->client_id != null)
                    {{ $order->cart->client->email }}
                @else
                    <div class="text-secondary">Anonimowy</div>
                @endif
            </td>
            <td class="align-middle"> {{ $order->total_price }} </td>
            <td class="align-middle custom-box"> {{ $order->status }} </td>
            <td class="align-middle"> {{ $order->created_at }} </td>
            <td class="align-middle">
                <div class="btn-group">
                    <a href="{{ route('admin.order.edit', ['id' => $order->id]) }}" class="btn btn-primary"><i class="me-2 bi bi-search"></i>Sprawdź</a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection