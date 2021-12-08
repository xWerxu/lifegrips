@extends('layouts.admin')

@section('content')
<div class="d-block">
    <h1 class="float-start"><i class="bi bi-list-ul me-2"></i>Produkty</h1>
    <a href="{{route('admin.article.create')}}" class="float-end btn btn-primary btn-lg"><i class="me-2 bi bi-plus-circle"></i>Nowy Wpis</a>
</div>
<br><br>
<hr class="d-block">
@if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
@elseif (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
@endif
<table class="table" id="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Zdjęcie</th>
            <th scope="col">Tytuł</th>
            <th scope="col">Tło banneru</th>
            <th scope="col">Tło produktów</th>
            <th scope="col">Opublikowany</th>
            <th scope="col">Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            <td class="align-middle" scope="row"> {{ $article->id }}</td>
            <td class="align-middle"><img class="m-0" src="{{ $article->image }}" style="height: 60; width: 100px;"></td>
            <td class="align-middle w-50"> {{ $article->title }} </td>
            <td class="align-middle" style="width: 110px"> 
                <div class="text-center align-middle" style="height: 60px; width:100px; background-color: {{ $article->background_color }}">{{ $article->background_color }}</div>
            </td>
            <td class="align-middle"> 
                <div class="text-center align-middle" style="height: 60px; width:100px; background-color: {{ $article->background_products }}">{{ $article->background_products }}</div>
            </td>
            <td class="align-middle"> {{ $article->published == 1 ? 'Tak' : 'Nie' }} </td>
            <td class="align-middle">
                <div class="btn-group">
                    <a href="{{ route('admin.article.edit', ['id' => $article->id]) }}" class="btn btn-warning"><i class="me-2 bi bi-pencil"></i>Edytuj</a>
                    <form method="POST" action="{{ route('admin.article.delete') }}" onsubmit="return confirm('Czy na pewno chcesz usunąć wpis {{ $article->title }}?');">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="article_id" value="{{ $article->id }}">
                        <button type="submit" class="btn btn-danger"><i class="me-2 bi bi-trash2"></i>Usuń</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection