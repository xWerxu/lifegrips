@extends('layouts.app')

@section('content')
    <!-- <div class="contianer">
        @foreach ($products as $product)
            @php
                $variant = $product->mainVariant
            @endphp
                <img class="img-thumbnail" style="width: 200px" src="{{ $variant->main_image }}">
            @foreach ($variant->images as $image)
                <img class="img-thumbnail" style="width: 100px" src="{{ $image->path }}">
            @endforeach
            <button data-id="{{ $variant->id }}" 
                {{-- Data quantity jest tylko do testowania tutaj --}}
                data-quantity="1"  class="btn btn-primary add-item">Zamów</button>
        <br>
        @endforeach
    </div> Komentuje to bo chce cokolwiek ruszyć a później będzie sie z tym bawiło -->
    <main-carousel src1="{{ asset('images/test1.jpg') }}" src2="{{ asset('images/test1.jpg') }}" src3="{{ asset('images/test1.jpg') }}"></main-carousel>

     <div class="container">
        <div class="row">
                <div class="col-xl-2 col-md-3 col-sm-12 mb-2">
                    <div class="card w-100 card-style">
                        <div class="card-body">
                            <h5 class="card-title">Kategorie:</h5>
                            <ul class="list-group"> 

                                @foreach ($categories as $category)
                                {{-- Do wariantu produktu dostajes się $produt->variant, więc np $product->variant->name --}}
                                {{-- Do child kategorii dostajesz się $category->categories, można dać w foreacha i wtedy ładnie lata --}}

                                <a href="#" class="list-group-item list-group-item-action border border-2 rounded-pill mb-2">
                                 {{ $category->name }}
                                </a>
                                @endforeach

                            </ul>
                        </div>
                    </div>        
                </div>
                <div class="col-xl-10 col-md-9 col-sm-12 mb-1 d-flex flex-wrap">
                @foreach ($products as $product)
                        <div class="col-md-5 col-xl-4">
                            <div class="card">
                                <div class="card-body product_styling">
                                
                                    {{-- Do wariantu produktu dostajes się $produt->variant, więc np $product->variant->name --}}
                                    {{-- Do child kategorii dostajesz się $category->categories, można dać w foreacha i wtedy ładnie lata --}}
    
                                     
                                     <h5 class="card-title">{{ $product->mainVariant->name  }}</h5>

                                <a href="#" class="list-group-item list-group-item-action border border-2 rounded-pill mb-2">
                                 {{ $product->mainVariant->name }}
                                </a>
                            </div>
                        </div>        
                </div>
                @endforeach
         </div>
     </div>
{{-- 
    Tutaj bym proponował sztuczkę taką że jest jeden modal bo ajax musi wziąc 
    pod ID więc tylko jeden formularz może być, więc formualrz jest w wyskakującym modalu,
    coś jak na kubkach i przy kliknięciu tylko podmienia się jego hidden input variant_id na 
    $variant->id, a quantity jest ustalane przez oddzielnego inputa, ewentualnie zrobić tak że z poziomu sklepu/kategorii
    dodawać się nie da, tylko na stronie samego produktu bo to też ma sens i będzie dużo łatwiejsze do zrobienia.
    --}}

    <div class="d-flex justify-content-center">
    <product-card></product-card>
    </div>
@endsection

