@extends('layouts.admin')

@section('content')
<h1><i class="bi bi-pencil mt-0 mt-md-5 me-2"></i>Zarządzaj pracownikami</h1>
<hr class="divider">
@if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
@elseif (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
@endif
<form class="d-flex w-50 mb-2 clearfix" method="get" action="{{ route('admin.employees.index') }}">
    <input class="form-control w-50 me-2 clearfix" type="search" name="q" placeholder="Email klienta" aria-label="Search">
    <button class="btn btn-outline-success clearfix" type="submit"><i class="me-2 bi bi-search"></i>Wyszukaj</button>
</form>
<div class="row">
  <div class="col-lg-6 col-sm-12">
    <div class="text-center">
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
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                <tr class="align-middle">
                    <td scope="row">{{ $customer->id }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->first_name ? $customer->first_name : 'Brak danych'}}</td>
                    <td>{{ $customer->last_name ? $customer->last_name : 'Brak danych' }}</td>
                    <td>
                        <form action="{{ route('admin.employees.updateEmployee') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" value="{{ $customer->id }}">
                        <button type="submit" name="employed" value="true" class="btn btn-success">
                            Dodaj pracownika
                        </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
  <div class="col-lg-6 col-sm-12">
      <h2 class="mb-3">Pracownicy</h2>
    <table class="table" id="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Email</th>
                <th scope="col">Imię</th>
                <th scope="col">Nazwisko</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr class="align-middle">
                <td scope="row">{{ $employee->id }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->first_name ? $employee->first_name : 'Brak danych'}}</td>
                <td>{{ $employee->last_name ? $employee->last_name : 'Brak danych' }}</td>
                <td>
                    <form action="{{ route('admin.employees.updateEmployee') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" value="{{ $employee->id }}">
                        <button class="btn btn-danger" value="submit" name="unemployed" value="true">
                            Usuń pracownika
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection