@extends('layouts.app')

@section('content')
    <div class="contianer">
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
                            <button type="submit" class="btn btn-danger remove-item" data-id="{{ $key }}" name="usun">Usuń</button>
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
                        <td>
                            <input type="number" class="form-control" name="quantity[{{ $item->id }}]" value="{{ $item->quantity }}">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-danger remove-item" data-id="{{ $item->id }}" name="usun">Usuń</button>
                        </td>
                    </tr>
                @endforeach
            @endauth
            </table>
            <button type="submit" name="aktualizuj" class="btn btn-primary">Aktualizuj</button>
        </form>
    </div>

    <script>
        $(".remove-item").click(function(){
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: "{{ route('remove-from-cart') }}",
                type: 'DELETE',
                data: {
                    "item_id": id,
                    "_token": token,
                }
            }).done(function(data){
                console.log(data);
            });
        });
    </script>
@endsection

