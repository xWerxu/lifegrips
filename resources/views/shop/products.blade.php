@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-3">
                <h3>Filtr Kategorii:</h3>
                <div class="list-group">

            
            @foreach($categories as $category)
                {{-- //     echo "<pre>";
                //     print_r($category->name);
                //     echo "</pre>"; --}}
                @foreach($category->categories as $value)
        

                    <li class='list-group-item'>
                    <checkbox-list name="{{ $value->name }}" value="{{ $value->name }}"></checkbox-list>
                    </li>

                @endforeach

  

            @endforeach
           
{{-- 
            @foreach($categories->$category->categories->name as $value)

            <checkbox-list data="{{ json_encode($value) }}"></checkbox-list>

            @endforeach --}}
                </div>
            </div>
            <div class="col-9">
                @if ($pages > 1)
                <ul class="pagination float-start">
                    @if ($current_page > 1)
                    <li class="page-item" href="#" aria-label="Poprzednia">
                        <a href="{{ url()->current() }}?page={{ $current_page - 1 }}&limit={{ $current_limit }}&q={{ $q }}" class="page-link">Poprzednia</a>
                    </li>
                    @endif
                    @for ($i=1; $i<=$pages; $i++)
                        <li class="page-item
                        @if ($i == $current_page)
                            active
                        @endif
                        "
                        >
                            <a href="{{ url()->current() }}?page={{ $i }}&limit={{ $current_limit }}&q={{ $q }}" class="page-link">{{ $i }}</a>
                        </li>
                    @endfor
                    @if ($current_page < $pages)
                    <li class="page-item" aria-label="Poprzednia">
                        <a href="{{ url()->current() }}?page={{ $current_page + 1 }}&limit={{ $current_limit }}&q={{ $q }}" class="page-link">Następna</a>
                    </li>
                    @endif
                </ul>
                @endif
                <ul class="pagination float-end">
                    @foreach ($limits as $limit)
                        <li class="page-item
                        @if ($limit == $current_limit)
                            active
                        @endif
                        ">
                            <a href="{{ url()->current() }}?page={{ $current_page }}&limit={{ $limit }}&q={{ $q }}" class="page-link">{{ $limit }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="row w-100 row-cols-2 row-cols-lg-3 g-2 g-lg-3">
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

