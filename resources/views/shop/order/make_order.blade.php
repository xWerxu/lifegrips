@extends('layouts.app')

@section('content')
    <div class="contianer">
    @if ($cart == null)
        Koszyk pusty : C
    @else
        <form method="POST" action="{{ route('cart.post-order') }}" class="justify-content-md-center">
            @csrf
            <div class="w-50 mx-auto">
            <label for="first_name" class="form-label">Imię</label>
            <input id="first_name" name="first_name" type="text" class="form-control text-center" @auth value="{{ Auth::user()->first_name}}" @endauth>
            </div>
            <br>
            <div class="w-50 mx-auto">
                <label for="last_name" class="form-label">Nazwisko</label>
                <input id="last_name" name="last_name" type="text" class="form-control text-center" @auth value="{{ Auth::user()->last_name }}" @endauth>
            </div>
            <br>
            <div class="w-50 mx-auto">
                <label for="email" class="form-label">Adres email</label>
                <input type="text" id="email" name="email" class="form-control text-center" @auth value="{{ Auth::user()->email }}" @endauth>
            </div>
            <br>
            <div class="w-50 mx-auto">
                <label for="phone_number" class="form-label">Numer telefonu</label>
                <input id="phone_number" name="phone_number" type="text" class="form-control text-center" @auth value="{{ Auth::user()->phone_number }}" @endauth>
            </div>
            <br>
            <div class="w-50 mx-auto">
                <label for="city" class="form-label">Miejscowość</label>
                <input id="city" name="city" type="text" class="form-control text-center" @auth value="{{ Auth::user()->city }}" @endauth>
            </div>
            <br>
            <div class="w-50 mx-auto">
                <label for="address" class="form-label">Adres</label>
                <input id="address" name="address" type="text" class="form-control text-center" @auth value="{{ Auth::user()->address }}" @endauth>
            </div>
            <br>
            <div class="w-50 mx-auto">
                <label for="postal_code" class="form-label">Kod pocztowy</label>
                <input id="postal_code" name="postal_code" type="text" class="form-control text-center" @auth value="{{ $user->postal_code }}" @endauth>
            </div>
            <br>
            <div class="w-50 mx-auto">
                <label for="postal_code" class="form-label">Płatność</label>
                @foreach ($payments as $payment)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment" value="{{ $payment->id }}">
                    <label class="form-check-label" for="flexRadioDefault1">
                        {{ $payment->name }}
                    </label>
                    </div>
                @endforeach
            </div>
            <div class="w-50 mx-auto">
                <label for="postal_code" class="form-label">Dostawa</label>
                @foreach ($shipments as $shipment)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="shipment" value="{{ $shipment->id }}">
                    <label class="form-check-label" for="flexRadioDefault1">
                        {{ $shipment->name }}
                    </label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Zamów</button>
        </form>
    @endif
    </div>
@endsection

