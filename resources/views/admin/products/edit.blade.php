@extends('layouts.admin')

@section('content')
@php
    $main_variant = $product->mainVariant
@endphp
<div class="d-block">
    <h1 class="float-start"><i class="me-2 bi bi-pencil"></i>{{ $main_variant->name }}</h1>
</div>
<br><br>
<hr class="d-block">
<form action="{{ route('admin.product.update') }}" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
    <div class="card">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="container">
                    <h2 class="mt-3 float-start">Główny wariant</h2>
                    <a href="{{route('admin.product.create')}}" class="mt-3 float-end btn btn-primary"><i class="me-2 bi bi-plus-circle"></i>Dodaj wariant</a>
                    <br><br>
                    <hr>
                    @error('main_variant')
                        <p class="d-block invalid-feedback">{{ $message }}</p>
                    @enderror
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" style="width: 20px"></th>
                                <th scope="col">Zdjęcie</th>
                                <th scope="col">Nazwa</th>
                                <th scope="col">Cena</th>
                                <th scope="col">Ilość</th>
                                <th scope="col" class="text-center">Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product->variants as $variant)
                            <tr>
                                <td class="align-middle">
                                    <div class="form-check text-center">
                                        <input class="form-check-input" type="radio" name="main_variant" value="{{ $variant->id }}"
                                        @if ($main_variant->id == $variant->id)
                                            checked="checked"
                                        @endif
                                        >
                                    </div>
                                </td>
                                <td scope="col" class="align-middle" style="width: 100px"><img class="m-0" src="{{ $variant->main_image }}" style="height: 100px; width: 100px;"></td>
                                <td class="align-middle text-break">{{ $variant->name }}</td>
                                <td class="align-middle">{{ $variant->price }} zł</td>
                                <td class="align-middle">{{ $variant->on_stock }} szt.</td>
                                <td class="align-middle text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-warning">Edytuj</button>
                                        <button class="btn btn-danger">Usuń</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <h2 class="mt-3">Opis</h2>
                <textarea id="description" rows="12" class="d-inline-block form-control w-75" name="description">{{ $product->description }}</textarea>
                <h2 class="mt-3">Kategorie</h2>
                <hr>
                @foreach ($categories as $category)
                <div class="col-lg-6 col-sm-12">
                    <div class="row">
                        <h4>{{ $category->name }}</h4>
                        @foreach ($category->categories as $child)
                        <div class="form-check ms-3">
                            <label class="form-check-label" for="{{ $child->category_id }}">{{ $child->name }}</label>
                            <input class="form-check-input" type="checkbox" value="{{ $child->category_id }}" id="{{ $child->category_id }}" name="categories[]"
                            @if (in_array($child->category_id, $selected))
                                checked
                            @endif
                            >
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
                <hr>
                <div class="form-check mt-3">
                    <input id="available" name="available" type="checkbox" class="form-check-input"
                    @if ($product->available == true)
                        checked
                    @endif
                    >
                    <label for="available" class="form-check-label">Dostępny</label>
                </div>
            </div>
        </div>
        <button class="btn btn-primary mt-5">Zapisz zmiany</button>
    </div>
</form>
@endsection