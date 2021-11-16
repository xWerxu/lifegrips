@extends('layouts.app')

@section('content')
    <div class="contianer">
        @foreach ($products as $product)
        @php
            $variant = $product->mainVariant
        @endphp
            <img class="img-thumbnail" style="width: 200px" src="{{ $variant->main_image }}">
        @foreach ($variant->images as $image)
            <img class="img-thumbnail" style="width: 100px" src="{{ $image->path }}">
        @endforeach
        <br>
        @endforeach
    </div>
@endsection