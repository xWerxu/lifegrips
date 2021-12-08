@extends('layouts.admin')

@section('content')
<script src="{{ asset('js/spectrum.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/spectrum.css') }}">

<h1><i class="bi bi-pencil me-2"></i>{{ $article->title }}</h1>
<hr class="divider">

<div class="container">
    <form class="form" method="POST" action="{{ route('admin.article.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 mb-3">
                        <h2>Zdjęcie</h2>
                        <img src="{{ $article->image }}" class="img-thumbnail" style="width: 100%">
                        <input class="form-control" type="file" accept="image/png, image/jpg" id="image" name="image">
                        @error('image')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-check">
                            <div class="row mt-3">
                                <div class="col-6">
                                    <input id="left" value="0" name="image_position" type="radio" checked class="form-check-input"
                                    @if ($article->image_position == 0)
                                        checked
                                    @endif
                                    >
                                    <label for="left" class="form-check-label">Zdjęcie z lewej strony</label>
                                </div>
                                <div class="col-6">
                                    <input id="right" value="1" name="image_position" type="radio" class="form-check-input"
                                    @if ($article->image_position == 1)
                                        checked
                                    @endif
                                    >
                                    <label for="right" class="form-check-label">Zdjęcie z prawej strony</label>
                                </div>
                            </div>
                            @error('image_position')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="col-6 mb-3">
                        <h2>Krótki opis</h2>
                        <textarea id="short_description" maxlength="512" rows="7" class="form-control" name="short_description">{{ $article->short_description }}</textarea>
                        @error('short_description')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
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
                </div>
                <h2 class="mt-3">Tytuł</h2>
                        <input type="text" class="form-control" value="{{ $article->title }}" id="title" name="title">
                        @error('title')
                            <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
                <div class="row mt-3">
                    <h2>Treść wpisu</h2>
                    <textarea name="content" id="content" rows="10" class="form-control">{{ $article->content }}</textarea>
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
                                <input class="form-check-input" type="checkbox" value="{{ $product->product_id }}" id="{{ $product->product_id }}" name="products[]"
                                @if (in_array($product->product_id, $selected))
                                    checked
                                @endif
                                >
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-check mt-3">
                    <input id="published" name="published" checked type="checkbox" class="form-check-input"
                    @if ($article->published == 1)
                        checked
                    @endif
                    >
                    <label for="published" class="form-check-label">Opublikowany</label>
                </div>
            <card-body>
        </div>
        <button class="btn btn-primary" type="submit">Zapisz zmiany</button>
    </form>
</div>

<script>
    $('#color-picker').spectrum({
    type: "component",
    color: "{{ $article->background_color }}",
    allowEmpty: false,
    preferredFormat: "hex",
    showAlpha: false
    });
    $('#color-picker2').spectrum({
    type: "component",
    color: "{{ $article->background_products }}",
    allowEmpty: false,
    preferredFormat: "hex",
    showAlpha: false
    });
</script>
@endsection