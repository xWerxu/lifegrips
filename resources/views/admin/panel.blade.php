@extends('layouts.admin')

@section('content')
    jestes adminem jak cos
    {{dump($order)}}
    {{dump($cart)}}
    <pre>
        @php
            print_r($items);
        @endphp
    </pre>
@endsection