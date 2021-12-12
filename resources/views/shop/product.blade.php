@extends('layouts.app')

@section('content')




    @php
    // echo "<pre>";
    //     print_r($product);
    //     print_r($product->description);
    //     print_r($product->available);
    //     print_r($product->mainVariant);
    //     print_r($product->mainVariant->product_id);
    //     print_r($product->mainVariant->name);
    //     print_r($product->mainVariant->on_stock);
    //     print_r($product->mainVariant->available);
        // print_r($product->mainVariant->main_image);
    //     print_r($product->mainVariant->price);

    //     print_r(json_encode($variant->images));
    // echo "</pre>";


    @endphp


<div class="container px-4  mt-5">
    <div class="row ">
        <div class="col-6 justify-content-center">
            <product-img side_images="{{json_encode($variant->images)}}" main_image="{{$product->mainVariant->main_image}}"></product-img>
        </div>
        <div class="col-6 justify-content-center">
            <product-info data="{{json_encode($product->mainVariant)}}"></product-info>

        </div>

    </div>
</div>






@endsection