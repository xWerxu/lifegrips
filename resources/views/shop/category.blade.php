@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-3">
            <h3>Filtr Kategorii:</h3>
            <div class="list-group">

                @php
                $temp = null;
                @endphp

        @foreach($filters as $id_filtru => $filtr)
        {{-- <checkbox-list name="{{ filtry[$id_filtru][$value] }}"></checkbox-list> --}}

            {{-- @php
            $temp = null;
            @endphp --}}

            @if (isset($filtr['values']))
            <h6 class="display-6">{{ $filtr['name'] }}</h6>
                @foreach($filtr['values'] as $value)
                
                <li class='list-group-item'>
                <checkbox-list name="filters[{{ $id_filtru }}][{{ $value }}]" value="{{ $value }}"></checkbox-list>
                </li>

                @endforeach
            @endif
        @endforeach
            </div>
        </div>
        <div class="col-9">
            <div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">
                @foreach($products as $product)
                    <div class="col">
                        <product-card product_id="{{ $product->mainVariant->id }}" img_src="{{ $product->mainVariant->main_image }}" title="{{ $product->mainVariant->name }}" text="{{ $product->mainVariant->price." zł" }}"></product-card>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

    <pre>
    @php 
        
    print_r($filters);

@endphp
</pre>

</div>

@endsection