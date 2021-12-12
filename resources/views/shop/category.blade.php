@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row w-100">
        <div class="col-3">
            <h3>Filtr Kategorii:</h3>
            <div class="list-group">
                <form method="GET">
                @foreach($filters as $id_filtru => $filtr)
                    @if (isset($filtr['values']))
                    <h6 class="display-6">{{ $filtr['name'] }}</h6>
                        @foreach($filtr['values'] as $value)
                        
                        <li class='list-group-item'>
                        <checkbox-list id="{{ $id_filtru }}{{ $value }}" name="filters[{{ $id_filtru }}][values][{{ $value }}]" value="{{ $value }}"></checkbox-list>
                        </li>

                        @endforeach
                    @endif
                @endforeach
                <br>
                <div class="btn-group">
                    <button type="submit" value="true" name="filtruj" class="btn btn-primary"><i class="me-2 bi bi-search"></i>Zastosuj filtry</button>
                    <a class="btn btn-danger" href="{{ route('shop.category', ['id' => $category->category_id]) }}">Resetuj filtry</a>
                </div>
                </form>
            </div>
        </div>
        @if (count($products) == 0)
            <div class="col-9">
                <div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">
                    <h1 class="display-6 text-secondary">Brak produktów :c</h1>
                </div>
            </div>
        @else
            @if ($display_variants == true)
                <div class="col-9">
                    <div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">
                        @foreach($products as $product)
                            <div class="col">
                                <product-card product_id="{{ $product->id }}" img_src="{{ $product->main_image }}" title="{{ $product->name }}" text="{{ $product->price." zł" }}"></product-card>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="col-9">
                    @if ($pages > 1)
                    <ul class="pagination float-start">
                        @if ($current_page > 1)
                        <li class="page-item" href="#" aria-label="Poprzednia">
                            <a href="{{ url()->current() }}?page={{ $current_page - 1 }}&limit={{ $current_limit }}" class="page-link">Poprzednia</a>
                        </li>
                        @endif
                        @for ($i=1; $i<=$pages; $i++)
                            <li class="page-item
                            @if ($i == $current_page)
                                active
                            @endif
                            "
                            >
                                <a href="{{ url()->current() }}?page={{ $i }}&limit={{ $current_limit }}" class="page-link">{{ $i }}</a>
                            </li>
                        @endfor
                        @if ($current_page < $pages)
                        <li class="page-item" aria-label="Poprzednia">
                            <a href="{{ url()->current() }}?page={{ $current_page + 1 }}&limit={{ $current_limit }}" class="page-link">Następna</a>
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
                            <a href="{{ url()->current() }}?page={{ $current_page }}&limit={{ $limit }}" class="page-link">{{ $limit }}</a>
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
            @endif
        @endif
        
    </div>
</div>

@endsection