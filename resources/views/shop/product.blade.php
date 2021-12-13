@extends('layouts.app')

@section('content')




    @php
    // echo "<pre>";
        // print_r($product);
        // print_r($product->description);
        // print_r($product->available);
        // print_r($product->mainVariant);
        // print_r($product->mainVariant->product_id);
        // print_r($product->mainVariant->name);
        // print_r($product->mainVariant->on_stock);
        // print_r($product->mainVariant->available);
        // print_r($product->mainVariant->main_image);
        // print_r($product->mainVariant->price);

        // print_r(json_encode($variant->images));

        // print_r($categories)
    // echo "</pre>";


    @endphp


<div class="container px-4  mt-5">
    <div class="card p-5">
        <div class="row">
            <div class="col-6 justify-content-center">
                <product-img side_images="{{json_encode($variant->images)}}" main_image="{{$variant->main_image}}"></product-img>
            </div>
            <div class="col-6 justify-content-center">
                <product-info data="{{json_encode($variant)}}"></product-info>

            </div>
        </div>
        <div class="mt-5">
            {{ $product->description }}
        </div>
    </div>
    <h2 class="display-4 mt-5">Wszystkie warianty tego produktu</h2>
    <div class="col-12">
        <div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">
            @foreach($product->variants as $sub_variant)
                <div class="col">
                    <product-card product_id="{{ $sub_variant->id }}" img_src="{{ $sub_variant->main_image }}" title="{{ $sub_variant->name }}" text="{{ $sub_variant->price." zł" }}"></product-card>
                </div>
            @endforeach
        </div>
    </div>
</div>






@endsection