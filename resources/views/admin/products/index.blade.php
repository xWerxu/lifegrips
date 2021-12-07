@extends('layouts.admin')

@section('content')
<div class="d-block">
    <h1 class="float-start"><i class="bi bi-list-ul me-2"></i>Produkty</h1>
    <a href="{{route('admin.product.create')}}" class="float-end btn btn-primary btn-lg"><i class="me-2 bi bi-plus-circle"></i>Nowy Produkt</a>
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
<form class="d-flex w-50 mb-2 clearfix" method="get" action="{{ route('admin.product.index') }}">
    <input class="form-control w-50 me-2 clearfix" type="search" name="q" placeholder="Nazwa produktu" aria-label="Search">
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
            <th>Zdjęcie</th>
            <th scope="col">ID</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Opis</th>
            <th scope="col">Cena</th>
            <th scope="col">Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
        @php
            $variant = $product->mainVariant
        @endphp
            <td class="align-middle"><img class="m-0" src="{{ $variant->main_image }}" style="height: 100px; width: 100px;"></td>
            <th class="align-middle" scope="row">{{ $product->product_id }}</th>
            <td class="align-middle"> {{ $variant->name }} </td>
            <td class="align-middle custom-box"> {{ $product->description }} </td>
            <td class="align-middle"> {{ $variant->price }} zł </td>
            <td class="align-middle">
                <div class="btn-group">
                    <a href="{{ route('admin.product.edit', ['id' => $product->product_id]) }}" class="btn btn-warning"><i class="me-2 bi bi-pencil"></i>Edytuj</a>
                    <form method="POST" action="{{ route('admin.product.delete') }}" onsubmit="return confirm('Czy na pewno chcesz usunąć produkt {{ $variant->name }} i wszystkie jego warianty?');">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                        <button type="submit" class="btn btn-danger"><i class="me-2 bi bi-trash2"></i>Usuń</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection