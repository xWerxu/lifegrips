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
            <button data-id="{{ $variant->id }}" 
                {{-- Data quantity jest tylko do testowania tutaj --}}
                data-quantity="1"  class="btn btn-primary add-item">Zamów</button>
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
{{-- <script>
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
</script>     --}}
@endsection

