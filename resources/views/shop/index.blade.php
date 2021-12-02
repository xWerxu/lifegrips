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
    <div class="container ">
     <div class="col mb-4">
         <div class="row">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators carousel-indicators-styling">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner carousel_style ">
            <div class="carousel-item active">
            <img src="{{ asset('images/test1.jpg') }}" class="d-block w-100" alt="test">
            </div>
            <div class="carousel-item">
            <img src="{{ asset('images/test1.jpg') }}" class="d-block w-100" alt="test">
            </div>
            <div class="carousel-item">
            <img src="{{ asset('images/test1.jpg') }}" class="d-block w-100" alt="test">
            </div>
        </div>
        <button class="carousel-control-prev " type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next " type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>
    </div>
     </div>

     <div class="container-fluid">
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
<script>
    $(".add-item").click(function(){
        var id = $(this).data("id");
        var quantity = $(this).data("quantity");
        var token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: "{{ route('add-to-cart') }}",
            type: 'POST',
            data: {
                "variant_id": id,
                "_token": token,
                "quantity": quantity,
            }
        }).done(function(data){
            console.log(data);
        });
    });
</script>
<style>
    .carousel_style{
        border-radius: 45px;
    }

    .carousel-inner{
         max-height: 350px;
    }

    .card-style{
        border-radius: 20px;
    }

    .product_styling{
        border-radius: 15px;
    }

    @media only screen and (max-width: 768px) {
        .carousel_style{
        border-radius: 10px;
         }

         .carousel-indicators-styling{
             
         }
    }

</style>    
@endsection

