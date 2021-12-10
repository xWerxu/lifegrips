@extends('layouts.app')

@section('content')
    <main-banner src_img="{{ asset('images/layout_banner.jpg') }}"></main-banner>

    <div class="container">
         <div class="row row-cols-4 g-4">
             @foreach($products as $product)
                  <div clas="col">
                      <product-card img_src="{{ $product->mainVariant->main_image }}" title="{{ $product->mainVariant->name }}" text="{{ $product->mainVariant->price }}" href_link="#" ></product-card>
                    </div>
             @endforeach
          </div>
    </div>


@endsection

