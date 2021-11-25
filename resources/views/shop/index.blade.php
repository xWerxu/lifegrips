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
            <form id="form" action="{{ route('add-to-cart') }}" method="GET">
                <input id="quantity" type="hidden" name="quantity" value="1">
                <input id="variant" type="hidden" name="variant_id" value="{{ $variant->id }}">
                <button onclick="addToCart()" type="submit" class="btn btn-primary">Zamów</button>
            </form>
        <br>
        @endforeach
    </div>
{{-- 
    Tutaj bym proponował sztuczkę taką że jest jeden modal bo ajax musi wziąc 
    pod ID więc tylko jeden formularz może być, więc formualrz jest w wyskakującym modalu,
    coś jak na kubkach i przy kliknięciu tylko podmienia się jego hidden input variant_id na 
    $variant->id, a quantity jest ustalane przez oddzielnego inputa, ewentualnie zrobić tak że z poziomu sklepu/kategorii
    dodawać się nie da, tylko na stronie samego produktu bo to też ma sens i będzie dużo łatwiejsze do zrobienia.
    --}}
<script>
    function addToCart(){
        $('#form').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: "{{route('add-to-cart')}}",
                method: 'GET',
                data: {
                    quantity: $('#quantity').val(),
                    variant_id: $('#variant').val(),
                }
            }).done(function(data){
                console.log(data);
            });
        });
    }
</script>    
@endsection

