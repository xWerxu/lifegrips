@extends('layouts.app')

@section('content')
    <div class="contianer">
    @if ($cart == null)
        Koszyk pusty : C
    @else
        <form method="POST" action="{{ route('cart.post-order') }}" class="justify-content-md-center">
            @csrf
            @method('post')
            <div class="w-50 mx-auto">
            <label for="first_name" class="form-label">Imię</label>
            <input id="first_name" name="first_name" type="text" class="form-control text-center" @auth value="{{ Auth::user()->first_name}}" @endauth>
            </div>
            @error('first_name')
                <div class="d-block invalid-feedback">{{ $message }}</div>
            @enderror
            <br>
            <div class="w-50 mx-auto">
                <label for="last_name" class="form-label">Nazwisko</label>
                <input id="last_name" name="last_name" type="text" class="form-control text-center" @auth value="{{ Auth::user()->last_name }}" @endauth>
            </div>
            @error('last_name')
                <div class="d-block invalid-feedback">{{ $message }}</div>
            @enderror
            <br>
            <div class="w-50 mx-auto">
                <label for="email" class="form-label">Adres email</label>
                <input type="text" id="email" name="email" class="form-control text-center" @auth value="{{ Auth::user()->email }}" @endauth>
            </div>
            @error('email')
                <div class="d-block invalid-feedback">{{ $message }}</div>
            @enderror
            <br>
            <div class="w-50 mx-auto">
                <label for="phone_number" class="form-label">Numer telefonu</label>
                <input id="phone_number" name="phone_number" type="text" class="form-control text-center" @auth value="{{ Auth::user()->phone_number }}" @endauth>
            </div>
            @error('phone_number')
                <div class="d-block invalid-feedback">{{ $message }}</div>
            @enderror
            <br>
            <div class="w-50 mx-auto">
                <label for="city" class="form-label">Miejscowość</label>
                <input id="city" name="city" type="text" class="form-control text-center" @auth value="{{ Auth::user()->city }}" @endauth>
            </div>
            @error('city')
                <div class="d-block invalid-feedback">{{ $message }}</div>
            @enderror
            <br>
            <div class="w-50 mx-auto">
                <label for="address" class="form-label">Adres</label>
                <input id="address" name="address" type="text" class="form-control text-center" @auth value="{{ Auth::user()->address }}" @endauth>
            </div>
            @error('address')
                <div class="d-block invalid-feedback">{{ $message }}</div>
            @enderror
            <br>
            <div class="w-50 mx-auto">
                <label for="postal_code" class="form-label">Kod pocztowy</label>
                <input id="postal_code" name="postal_code" type="text" class="form-control text-center" @auth value="{{ Auth::user()->postal_code }}" @endauth>
            </div>
            @error('postal_code')
                <div class="d-block invalid-feedback">{{ $message }}</div>
            @enderror
            <br>
            <div class="w-50 mx-auto">
                <label class="form-label">Płatność</label>
                @error('payment')
                    <div class="d-block invalid-feedback">{{ $message }}</div>
                @enderror
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
                <label class="form-label">Dostawa</label>
                @error('shipment')
                    <div class="d-block invalid-feedback">{{ $message }}</div>
                @enderror
                @foreach ($shipments as $shipment)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="shipment" value="{{ $shipment->id }}">
                    <label class="form-check-label" for="flexRadioDefault1">
                        {{ $shipment->name }} - {{$free_shipment == 1 ? 'Darmowa z kodem ' . $coupon->coupon : $shipment->price . ' zł'}}
                    </label>
                    </div>
                @endforeach
            </div>
            <div class="w-25 float-end">
            Tutaj podsumowanie cenowe jest:
            @if ($coupon != null)
                <h5>{{ number_format($total_price,2) }} zł</h5>

                <h5 class="text-secondary">-{{ number_format(($total_price / 100) * $coupon->promotion,2) }} zł</h5>
                <div class="text-primary display-1">{{ number_format($total_price - ($total_price / 100) * $coupon->promotion,2) }} zł</div>
            </div>
            @else
            <div class="text-primary display-1">{{ number_format($total_price, 2) }} zł</div>
            </div>
            @endif
            <br><br>
            <div class="text-center">
            <button type="submit" class="btn btn-primary">Zamów</button>
            </div>
        </form>
    @endif
    </div>
@endsection

