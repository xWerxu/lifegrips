@extends('layouts.app')

@section('content')
    <div class="container">
        
            <div class="col-md-8">
                No tutaj jest strona główna póki co i tyle w sumie
            </div>
            @auth
            <button type="button" class="btn btn-primary btn-link">
                <a href="{{route('user.profile')}}">Profil</a>
            </button>    
            <button type="button" class="btn btn-primary">Primary</button>
<button type="button" class="btn btn-secondary">Secondary</button>
<button type="button" class="btn btn-success">Success</button>
<button type="button" class="btn btn-danger">Danger</button>
<button type="button" class="btn btn-warning">Warning</button>
<button type="button" class="btn btn-info">Info</button>
<button type="button" class="btn btn-light">Light</button>
<button type="button" class="btn btn-dark">Dark</button>

<button type="button" class="btn btn-link">Link</button>
            @endauth
        
    </div>
@endsection
