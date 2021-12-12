@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-3">
                <h3>Filtr Kategorii:</h3>
                <div class="list-group">

            @php 
            foreach($categories as $category)
            {
                //     echo "<pre>";
                //     print_r($category->name);
                //     echo "</pre>";
                foreach($category->categories as $value)
                {

                    echo "<li class='list-group-item'>";
                    echo "<checkbox-list data=".json_encode($value->name)."></checkbox-list>";
                    echo "</li>";

                }

  

            }
           


            @endphp
{{-- 
            @foreach($categories->$category->categories->name as $value)

            <checkbox-list data="{{ json_encode($value) }}"></checkbox-list>

            @endforeach --}}
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
        <checkbox-list></checkbox-list>

    </div>


@endsection

