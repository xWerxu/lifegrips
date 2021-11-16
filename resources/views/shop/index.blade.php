@extends('layouts.app')

@section('content')
    <div class="contianer">
        @foreach ($products as $product)
        {{ $product->product_idproduct->mainVariant->main_image product->mainVariant->main_image  }}
        <img src="{{ $product->mainVariant->main_image }}">
        @endforeach
    </div>
@endsection