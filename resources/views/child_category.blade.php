<li class="list-group-item">{{ $child_category->name }}</li>
@if ($child_category->categories)
    <ul class="list-group">
        @foreach ($child_category->categories as $childCategory)
            @include('child_category', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif