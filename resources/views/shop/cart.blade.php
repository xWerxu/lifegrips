@extends('layouts.app')

@section('content')
    <div class="contianer">
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
                    <td>{{ $item['quantity'] }}</td>
                    <td>
                        <form method="POST" action="{{ route('remove-from-cart') }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="item_id" value="{{ $key }}">
                            <button type="submit" class="btn btn-danger" name="usun">Usuń</button>
                        </form>
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
                    <td scope="col" style="width: 100px"><img style="height: 100px; width: 100px;" src="{{ $variant->main_image }}"</td>
                    <td>{{ $variant->name }}</td>
                    <td>{{ $variant->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>
                        <form method="POST" action="{{ route('remove-from-cart') }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-danger" name="usun">Usuń</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endauth
        </table>
    </div>

@endsection

