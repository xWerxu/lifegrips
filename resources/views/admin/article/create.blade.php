@extends('layouts.admin')

@section('content')
<script src="{{ asset('js/spectrum.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/spectrum.css') }}">

<h1><i class="bi bi-plus-circle me-2"></i>Nowy Wpis</h1>
<hr class="divider">

<div class="container">
    <form class="form" method="POST" action="{{ route('admin.article.create') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 mb-3">
                        <h2>Zdjęcie</h2>
                        <input class="form-control" type="file" accept="image/png, image/jpg" id="image" name="image">
                        @error('image')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-check">
                            <div class="row mt-3">
                                <div class="col-6">
                                    <input id="left" value="0" name="image_position" type="radio" class="form-check-input">
                                    <label for="left" class="form-check-label">Zdjęcie z lewej strony</label>
                                </div>
                                <div class="col-6">
                                    <input id="right" value="1" name="image_position" checked type="radio" class="form-check-input">
                                    <label for="right" class="form-check-label">Zdjęcie z prawej strony</label>
                                </div>
                            </div>
                            @error('image_position')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h2 class="mt-3">Kolor tła baneru</h2>
                                <input class="form-control" id="color-picker" name="background_color"/>
                            </div>
                            <div class="col-6">
                                <h2 class="mt-3">Kolor tła produktów</h2>
                                <input class="form-control" id="color-picker2" name="background_products"/>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-6 mb-3">
                        <h2>Krótki opis</h2>
                        <textarea id="short_description" maxlength="512" rows="7" class="form-control" name="short_description">Ten opis będzie wyświetlał się na stronie głównej</textarea>
                        @error('short_description')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <h2 class="mt-3">Tytuł</h2>
                        <input type="text" class="form-control" id="title" name="title">
                        @error('title')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
                <div class="row mt-3">
                    <h2>Treść wpisu</h2>
                    <textarea name="content" id="content" rows="10" class="form-control">Tutaj wpisz treść wpisu</textarea>
                </div>
                <h2 class="mt-3">Produkty powiązane z wpisem</h2>
                @error('products')
                    <div class="d-block invalid-feedback">{{ $message }}</div>
                @enderror
                <hr class="divider">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-lg-3 col-sm-12">
                            <div class="form-check ms-3">
                                <label class="form-check-label" for="{{ $product->product_id }}">{{ $product->mainVariant->name }}</label>
                                <input class="form-check-input" type="checkbox" value="{{ $product->product_id }}" id="{{ $product->product_id }}" name="products[]">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-check mt-3">
                    <input id="published" name="published" checked type="checkbox" class="form-check-input">
                    <label for="published" class="form-check-label">Opublikuj po utworzeniu</label>
                </div>
            <card-body>
        </div>
        <button class="btn btn-primary" type="submit">Dodaj</button>
    </form>
</div>

<script>
    $('#color-picker').spectrum({
    type: "component",
    color: "888888",
    allowEmpty: false,
    preferredFormat: "hex",
    showAlpha: false
    });
    $('#color-picker2').spectrum({
    type: "component",
    color: "555555",
    allowEmpty: false,
    preferredFormat: "hex",
    showAlpha: false
    });
</script>
@endsection