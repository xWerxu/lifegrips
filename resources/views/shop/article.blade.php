@extends('layouts.app')

@section('content')


<div class="container">
    <div class="card mt-5">
        <div class="row mt-5">
            <div class="col-6 pt-0 p-5">
                <h1 class="display-5" style="color: {{ $article->background_color }}">{{ $article->title }}</h1>
                <p class="small" style="color: {{ $article->background_products }}">{{ $article->short_description }}</p>
            </div>
            <div class="col-6">
                <img src="{{ $article->image }}" alt="{{ $article->title }}"
                style="-webkit-box-shadow: 14px -14px 0px 0px {{ $article->background_products }};
                -moz-box-shadow: 14px -14px 0px 0px {{ $article->background_products }};
                box-shadow: 14px -14px 0px 0px {{ $article->background_products }};"
                >
            </div>
        </div>
        <p class="m-5">{{ $article->content }}</p>
        @if (count($article->products) > 0)
            <h1 class="m-3 display-6 w-100" style="color: {{ $article->background_color }}">Powiązane produkty</h1>
            <div class="m-3 d-flex space-even row row-cols-2 row-cols-lg-3 g-2 g-lg-3" style="background-color: {{ $article->background_products }}; border-bottom: solid {{ $article->background_color }} 75px">
                @foreach($article->products as $product)
                    <div class="col mb-3">
                        <product-card product_id="{{ $product->mainVariant->id }}" img_src="{{ $product->mainVariant->main_image }}" title="{{ $product->mainVariant->name }}" text="{{ $product->mainVariant->price." zł" }}"></product-card>
                    </div>
                @endforeach
            </div>
        @endif
        
    </div>
</div>
@endsection