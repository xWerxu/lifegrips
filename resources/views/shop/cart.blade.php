@extends('layouts.app')

@section('content')
    <div class="contianer">
        <jq-injection></jq-injection>
        @if ($cart == null)
            Koszyk pusty : C
        @else
        <form class="form" method="POST" accept="{{ route('update-cart') }}">
            @csrf
            @method('POST')
            <table class="table">
                <thead>
                    <th scope="col">Zdjęcie</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">Cena</th>
                    <th scope="col">Ilość</th>
                    <th></th>
                </thead>
            @guest
                @foreach ($cart as $key=>$item)
                    <tr>
                        <td scope="col" style="width: 100px"><img style="height: 100px; width: 100px;" src="{{ $item['image'] }}"</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['price'] }}</td>
                        <td>
                            <input type="number" class="form-control" name="quantity[{{ $key }}]" value="{{ $item['quantity'] }}">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-item" data-id="{{ $key }}" name="usun">Usuń</button>
                        </td>
                    </tr>
                @endforeach
            @endguest
            @auth
                @foreach ($cart->items as $item)
                @php
                    $variant = $item->variant;
                @endphp
                    <tr>
                        <td scope="col" style="width: 100px"><img style="height: 100px; width: 100px;" src="{{ $variant->main_image }}"></td>
                        <td>{{ $variant->name }}</td>
                        <td>{{ $variant->price }}</td>
                        <td>
                            <input type="number" class="form-control" name="quantity[{{ $item->id }}]" value="{{ $item->quantity }}">
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-item" data-item_id="{{ $item->id }}" name="usun">Usuń</button>
                        </td>
                    </tr>
                @endforeach
            @endauth
            </table>
            @auth
                @if ($cart->coupon_id == null)
                <label class="form-label">Kod rabatowy:</label>
                <input type="text" name="coupon" class="form-control">
                @else
                    Użyto kuponu {{ $cart->coupon->coupon }}
                @endif
            @endauth
            @guest
                @if ($coupon == null)
                    <label class="form-label">Kod rabatowy:</label>
                    <input type="text" name="coupon" class="form-control">
                @else
                    Użyto kuponu {{ $coupon }}
                @endif
            @endguest
            <br>
            <button type="submit" name="aktualizuj" class="btn btn-primary">Aktualizuj</button>
        </form>
        <br>
        <a href="{{ route('cart.order') }}" class="btn btn-primary">Zamów</a>
    </div>
    @endif

@endsection

