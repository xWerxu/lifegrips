@extends('layouts.admin')

@section('content')
<h1><i class="bi bi-plus-circle me-2"></i>Edytuj Wariant</h1>
<hr class="divider">

<div class="container">
    {{-- {{dd($filters)}} --}}
    <form class="form" method="POST" action="{{ route('admin.variant.update') }}"  enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="variant_id" value="{{ $variant->id }}">
        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 mb-3">
                        <h2>Zdjęcie główne</h2>
                        <img src="{{ $variant->main_image }}" class="img-thumbnail mt-3" style="width: 100%">
                        <input class="form-control" type="file" accept="image/png, image/jpg" id="main" name="main">
                        @error('main')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6 mb-3">
                        <h2>Zdjęcia dodatkowe</h2>
                        <div class="row">
                            @foreach ($variant->images as $image)
                                <div class="col-6 mt-3">
                                    <img src="{{ $image->path }}" class="img-thumbnail" style="width: 100%">
                                    <div type="submit" class="btn btn-danger w-100">
                                        <div class="form-check ms-3">
                                            <label for="{{ $image->image_id }}" class="form-check-label">Usuń</label>
                                            <input class="form-check-input" type="checkbox" value="{{ $image->image_id }}" id="{{ $image->image_id }}" name="remove[]">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <input class="form-control mt-1" multiple="multiple" type="file" accept="image/png, image/jpg" id="adds" name="adds[]">
                        @error('adds.*')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <h2 class="mt-3">Nazwa</h2>
                <input type="text" class="form-control" id="name" name="name" value="{{ $variant->name }}">
                @error('name')
                    <div class="d-block invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="row mt-3">
                    <div class="col-6">
                        <h2>Cena</h2>
                        <input class="form-control" type="text" name="price" pattern="^\d+(.\d{1,2})?$" value="{{ $variant->price }}">
                        @error('price')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <h2>Ilość</h2>
                        <input name="on_stock" type="number" class="form-control" min="0" value="{{ $variant->on_stock }}">
                        @error('on_stock')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                @if (count($filters) > 0)
                    <div class="row mt-3">
                        <h2>Cechy wariantu</h2>
                        <p class="text-secondary">Zostaw puste, jeśli chcesz daną cechę usunąć</p>
                        <div class="row">
                            @foreach ($filters as $id => $filter)
                                <div class="col-6">
                                    <label class="form-label">{{ $filter['name'] }}</label>
                                    <input type="text" class="form-control" value="{{ $filter['value'] }}" name="filters[{{ $id }}]">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="form-check mt-3">
                    <input id="available" name="available" type="checkbox" class="form-check-input"
                    @if ($variant->available == true)
                        checked
                    @endif
                    >
                    <label for="available" class="form-check-label">Dostępny</label>
                </div>
            <card-body>
        </div>
        @method('PUT')
        <button class="btn btn-primary" type="submit">Zapisz zmiany</button>
    </form>
</div>
@endsection