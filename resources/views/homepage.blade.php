@extends('layouts.app')

@section('content')
<style>
    .just-padding {
  padding: 15px;
}

.list-group.list-group-root {
  padding: 0;
  overflow: hidden;
}

.list-group.list-group-root .list-group {
  margin-bottom: 0;
}

.list-group.list-group-root .list-group-item {
  border-radius: 0;
  border-width: 1px 0 0 0;
}

.list-group.list-group-root > .list-group-item:first-child {
  border-top-width: 0;
}

.list-group.list-group-root > .list-group > .list-group-item {
  padding-left: 30px;
}

.list-group.list-group-root > .list-group > .list-group > .list-group-item {
  padding-left: 45px;
}
</style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                No tutaj jest strona główna póki co i tyle w sumie
            </div>
            @auth
            <div>
                Jesteś zalogowany jak coś
                <ul class="list-group list-group-root well">
                    @foreach ($categories as $category)
                        <li class="list-group-item">{{ $category->name }}</li>
                        <ul class="list-group">
                        @foreach ($category->childrenCategories as $childCategory)
                            @include('child_category', ['child_category' => $childCategory])
                        @endforeach
                        </ul>
                    @endforeach
                </ul>
            </div>
            @endauth
        </div>
    </div>
@endsection
