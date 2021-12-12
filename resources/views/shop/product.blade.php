@extends('layouts.app')

@section('content')
<pre>
    @php
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

        print_r($product->variants);


    @endphp
</pre>
<product-card product_id="{{ $product->mainVariant->id }}" img_src="{{ $product->mainVariant->main_image }}" title="{{ $product->mainVariant->name }}" text="{{ $product->mainVariant->price." zł" }}"></product-card>





@endsection