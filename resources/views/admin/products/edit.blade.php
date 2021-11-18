@extends('layouts.admin')

@section('content')
@php
    $main_variant = $product->mainVariant
@endphp
<div class="d-block">
    <h1 class="float-start"><i class="me-2 bi bi-pencil"></i>{{ $main_variant->name }}</h1>
</div>
<br><br>
<hr class="d-block">
<form>
    <div class="card">
        <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="container">
                        <h2 class="mt-3 float-start">Główny wariant</h2>
                        <a href="{{route('admin.product.create')}}" class="mt-3 float-end btn btn-primary"><i class="me-2 bi bi-plus-circle"></i>Dodaj wariant</a>
                        <br><br>
                        <hr>
                        <table class="table">
                            <tbody>
                                @foreach ($product->variants as $variant)
                                <tr>
                                    <td scope="col" style="width: 100px"><img class="m-0" src="{{ $variant->main_image }}" style="height: 100px; width: 100px;"></td>
                                    <td class="align-middle">{{ $variant->name }}</td>
                                    <td class="align-middle">{{ $variant->price }} zł</td>
                                    <td class="align-middle">
                                        <div class="form-check text-center">
                                            <input class="form-check-input" type="radio" name="main_variant" value="{{ $variant->id }}"
                                            @if ($main_variant->id == $variant->id)
                                                checked="checked"
                                            @endif
                                            >
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-warning">Edytuj</button>
                                            <button class="btn btn-danger">Usuń</button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <h2 class="mt-3">Opis</h2>
                    <textarea id="description" rows="12" class="d-inline-block form-control w-75" name="description">{{ $product->description }}</textarea>
                </div>
        </div>
        <button class="btn btn-primary mt-5">Zapisz zmiany</button>
    </div>
</form>
{{-- {{ dump($product) }} --}}
@endsection