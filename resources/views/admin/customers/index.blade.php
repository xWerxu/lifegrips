@extends('layouts.admin')

@section('content')
<div class="d-block">
    <h1 class="float-start"><i class="bi bi-list-ul me-2"></i>Klienci</h1>
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
<form class="d-flex w-50 mb-2 clearfix" method="get" action="{{ route('admin.customer.index') }}">
    <input class="form-control w-50 me-2 clearfix" type="search" name="q" placeholder="Email klienta" aria-label="Search">
    <button class="btn btn-outline-success clearfix" type="submit"><i class="me-2 bi bi-search"></i>Wyszukaj</button>
</form>
@if ($pages > 1)
<ul class="pagination float-start">
    @if ($current_page > 1)
    <li class="page-item" href="#" aria-label="Poprzednia">
        <a href="{{ url()->current() }}?page={{ $current_page - 1 }}&limit={{ $current_limit }}&q={{ $q }}" class="page-link">Poprzednia</a>
    </li>
    @endif
    @for ($i=1; $i<=$pages; $i++)
        <li class="page-item
        @if ($i == $current_page)
            active
        @endif
        "
        >
            <a href="{{ url()->current() }}?page={{ $i }}&limit={{ $current_limit }}&q={{ $q }}" class="page-link">{{ $i }}</a>
        </li>
    @endfor
    @if ($current_page < $pages)
    <li class="page-item" aria-label="Poprzednia">
        <a href="{{ url()->current() }}?page={{ $current_page + 1 }}&limit={{ $current_limit }}&q={{ $q }}" class="page-link">Następna</a>
    </li>
    @endif
</ul>
@endif
<ul class="pagination float-end">
    @foreach ($limits as $limit)
        <li class="page-item
        @if ($limit == $current_limit)
            active
        @endif
        ">
            <a href="{{ url()->current() }}?page={{ $current_page }}&limit={{ $limit }}&q={{ $q }}" class="page-link">{{ $limit }}</a>
        </li>
    @endforeach
</ul>
<table class="table" id="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Email</th>
            <th scope="col">Imię</th>
            <th scope="col">Nazwisko</th>
            <th scope="col">Miejscowość</th>
            <th scope="col">Kod pocztowy</th>
            <th scope="col">Adres</th>
            <th scope="col">Numer telefonu</th>
            <th scope="col">Konto utworzone</th>
            <th scope="col">Email potwierdzony</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
        <tr class="align-middle">
            <td scope="row">{{ $customer->id }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->first_name }}</td>
            <td>{{ $customer->last_name }}</td>
            <td>{{ $customer->city }}</td>
            <td>{{ $customer->postal_code }}</td>
            <td>{{ $customer->address }}</td>
            <td>{{ $customer->phone_number }}</td>
            <td>{{ $customer->created_at }}</td>
            <td>{{ $customer->email_verfied_at == null ? 'nie' : $customer->email_verified_at }}</td>
            <td><a class="btn btn-primary" href="{{ route('admin.customer.show', ['id' => $customer->id]) }}"><i class="me-2 bi bi-search"></i>Szczegóły</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection