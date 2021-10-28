@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                No tutaj jest strona główna póki co i tyle w sumie
            </div>
            @auth
            <div>
                Jesteś zalogowany jak coś
            </div>
            @endauth
        </div>
    </div>
@endsection
