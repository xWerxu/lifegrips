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
<table class="table">
    <thead>
        <tr>
            <th style="height: 110px; width:110px;">Zdjęcie</th>
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
            <td class="align-middle"> {{ $product->description }} </td>
            <td class="align-middle"> {{ $variant->price }} zł </td>
            <td class="align-middle">
                <div class="btn-group">
                    <button class="btn btn-secondary"><i class="me-2 bi bi-search"></i>Szczegóły</button>
                    <button class="btn btn-warning"><i class="me-2 bi bi-pencil"></i>Edytuj</button>
                    <button class="btn btn-danger"><i class="me-2 bi bi-trash2"></i>Usuń</button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection