@extends('layouts.admin')

@section('content')
<h1><i class="bi bi-plus-circle me-2"></i>Nowy Wariant</h1>
<hr class="divider">

<div class="container">
    <form class="form" action="{{ route('admin.variant.postCreate') }}" method="POST"  enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product_id }}">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 mb-3">
                        <h2>Zdjęcie główne</h2>
                        <input class="form-control" type="file" accept="image/png, image/jpg" id="main" name="main">
                        @error('main')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6 mb-3">
                        <h2>Zdjęcia dodatkowe</h2>
                        <input class="form-control" multiple="multiple" type="file" accept="image/png, image/jpg" id="adds" name="adds[]">
                        @error('adds.*')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <h2 class="mt-3">Nazwa</h2>
                <input type="text" class="form-control" id="name" name="name">
                @error('name')
                    <div class="d-block invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="row mt-3">
                    <div class="col-6">
                        <h2>Cena</h2>
                        <input class="form-control" type="text" name="price" pattern="^\d+(.\d{1,2})?$">
                        @error('price')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <h2>Ilość</h2>
                        <input name="on_stock" type="number" class="form-control" min="0">
                        @error('on_stock')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-check mt-3">
                    <input id="available" name="available" checked type="checkbox" class="form-check-input">
                    <label for="available" class="form-check-label">Dostępny</label>
                </div>
            <card-body>
        </div>
        <button class="btn btn-primary" type="submit">Dodaj</button>
    </form>
</div>
@endsection