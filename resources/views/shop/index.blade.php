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
                <div class="col-md-4 col-sm-12 mb-2">
                    <div class="card w-100">
                        <div class="card-body">
                            <ul class="list-group"> 
  
                                <li class="list-group-item">
                                    An item
                                </li>

                                @foreach ($products as $product)

                                <li class="list-group-item">
                                 {{ $product->name }}
                                </li>
                                
                                @endforeach

                            </ul>
                        </div>
                    </div>        
                </div>
                <div class="col-md-8 col-sm-12 mb-2">
                        <div class="card w-100">
                            <div class="card-body">
                                test
                            </div>
                        </div>        
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

    @media only screen and (max-width: 768px) {
        .carousel_style{
        border-radius: 10px;
         }

         .carousel-indicators-styling{
             
         }


    }

</style>    
@endsection

