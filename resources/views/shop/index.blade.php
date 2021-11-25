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
            <form action="{{ route('add-to-cart') }}" method="GET">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="variant_id" value="{{ $variant->id }}">
                <button type="submit" class="btn btn-primary">Zamów</button>
            </form>
        <br>
        @endforeach
    </div>

<script>
    
</script>    
@endsection

