@extends('layouts.admin')

@section('content')
<h1><i class="bi bi-list-ul me-2"></i>Kategorie</h1>
<hr class="divider">
<div class="row">
  <div class="col-4">
    <div class="text-center">
      <h1 class="fw-light">Dodaj kategorię</h1>
      <br>
      <form class="form" method="post" action="{{ route('admin.category.create') }}">
        @csrf
        <input type="text" class="form-control" required name="name"><br>
        <select class="form-select" name="parent_id">
          <option value="null">Brak</option>
          @foreach ($categories as $option)
            <option value="{{ $option->category_id }}">{{ $option->name }}</option>
          @endforeach
        </select><br>
        <button type="submit" class="btn btn-primary btn-lg"><i class="me-2 bi bi-plus-circle"></i>Dodaj</button>
      </form>
    </div>
  </div>
  <div class="col-8">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nazwa</th>
          <th scope="col">Kategoria nadrzędna</th>
          <th scope="col">Akcje</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($categories as $category)
          <tr>
              <th scope="row">{{ $category->category_id }}</th>
              <td> {{ $category->name }} </td>
              <td> {{ $category->parent_id != null ? $category->parent()->name : '' }} </td>
              <td>
                  <div class="btn-group">
                      <button class="btn btn-secondary"><i class="me-2 bi bi-search"></i>Sprawdź</button>
                      <button class="btn btn-warning"><i class="me-2 bi bi-pencil"></i>Edytuj</button>
                      <button class="btn btn-danger"><i class="me-2 bi bi-trash2"></i>Usuń</button>
              </div>
              </td>
          <tr>
          @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection