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
    <main-banner src_img="{{ asset('images/layout_banner.jpg') }}"></main-banner>
    <frontpage-label src_img="{{ asset('images/label_image/drake1.png') }}"></frontpage-label>
    <frontpage-label src_img="{{ asset('images/label_image/drake1.png') }}"></frontpage-label>



{{-- Do wariantu produktu dostajes się $produt->variant, więc np $product->variant->name --}}
{{-- Do child kategorii dostajesz się $category->categories, można dać w foreacha i wtedy ładnie lata --}}

{{-- Do wariantu produktu dostajes się $produt->variant, więc np $product->variant->name --}}
{{-- Do child kategorii dostajesz się $category->categories, można dać w foreacha i wtedy ładnie lata --}}

{{-- 
    Tutaj bym proponował sztuczkę taką że jest jeden modal bo ajax musi wziąc 
    pod ID więc tylko jeden formularz może być, więc formualrz jest w wyskakującym modalu,
    coś jak na kubkach i przy kliknięciu tylko podmienia się jego hidden input variant_id na 
    $variant->id, a quantity jest ustalane przez oddzielnego inputa, ewentualnie zrobić tak że z poziomu sklepu/kategorii
    dodawać się nie da, tylko na stronie samego produktu bo to też ma sens i będzie dużo łatwiejsze do zrobienia.
    --}}


@endsection

