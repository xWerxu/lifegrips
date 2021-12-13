<li class="list-group-item"><a class="stretched-link link" href="{{ route('shop.category', ['id' => $child_category->category_id]) }}">{{ $child_category->name }}</a></li>
@if ($child_category->categories)
    <ul class="list-group">
        @foreach ($child_category->categories as $childCategory)
            @include('child_category', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif