@extends('layouts.admin')

@section('content')
<h1><i class="bi bi-list-ul mt-0 mt-md-5"></i>Kategorie</h1>
<hr class="divider">
@if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
@elseif (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
@endif
<div class="row">
  <div class="col-lg-4 col-sm-12">
    <div class="text-center">
      <h1 class="fw-light">Dodaj kategorię</h1>
      <br>
      <form class="form" method="post" action="{{ route('admin.category.create') }}">
        @csrf
        <label class="form-label">Nazwa</label>
        <input type="text" class="form-control" required name="name"><br>
        <label class="form-abel">Kategoria nadrzędna</label>
        <select class="form-select" name="parent_id">
          <option value="null">Brak</option>
          @foreach ($mains as $option)
            <option value="{{ $option->category_id }}">{{ $option->name }}</option>
          @endforeach
        </select><br>
        <button type="submit" class="btn btn-primary btn-lg"><i class="me-2 bi bi-plus-circle"></i>Dodaj</button>
      </form>
    </div>
  </div>
  <div class="col-lg-8 col-sm-12">
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
              @if ($category->hasChildren() == true)
                <div class="d-none" id="hasChildren{{ $category->category_id }}">true</div>
              @else
                <div class="d-none" id="hasChildren{{ $category->category_id }}">false</div>
              @endif
              <th scope="row">{{ $category->category_id }}</th>
              <td id="name{{ $category->category_id }}"> {{ $category->name }} </td>
              <td id="parent{{ $category->category_id }}"> {{ $category->parent_id != null ? $category->parent()->name : '' }} </td>
              <td>
                  <div class="btn-group">
                      <button class="btn btn-secondary"><i class="me-2 bi bi-search"></i>Sprawdź</button>
                      <button class="btn btn-warning" onclick="edit({{ $category->category_id }})" data-bs-toggle="modal" data-bs-target="#formModal"><i class="me-2 bi bi-pencil"></i>Edytuj</button>
                      <form method="POST" action="{{ route('admin.category.delete') }}" onsubmit="return confirm('Czy na pewno chcesz usunąć kategorię {{ $category->name }}?');">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="category_id" value="{{ $category->category_id }}">
                        <button type="submit" class="btn btn-danger"><i class="me-2 bi bi-trash2"></i>Usuń</button>
                      </form>
              </div>
              </td>
          <tr>
          @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <form class="form" method="POST" action="{{ route('admin.category.update') }}">
          @csrf
          @method('PUT')
          <input type="hidden" id="category_id_input" name="category_id" value="">
          <label for="name_input" class="form-label">Nazwa kategorii</label>
          <input class="form-control" type="text" id="name_input" name="name" value="">
          <br>
          <label class="form-label">Kategoria nadrzędna</label>
          <select class="form-select" name="parent_id" id="parent_id_input">
            <option value="null">Brak</option>
            @foreach ($mains as $option)
              <option value="{{ $option->category_id }}">{{ $option->name }}</option>
            @endforeach
          </select><br>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
            <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function edit(id){
    const title = document.getElementById("formModalLabel");
    const category_id = document.getElementById("category_id_input");
    const parent_id = document.getElementById("parent_id_input");
    const name = document.getElementById("name_input");

    let has_child = document.getElementById("hasChildren" + id).innerHTML;
    let name_val = document.getElementById("name" + id).innerHTML;
    let parent_val = document.getElementById("parent" + id).innerHTML;
    parent_val = parent_val.replace(/\s/g, '');
    name_val = name_val.replace(/\s/g, '')

    title.innerHTML = "Edytuj " + name_val;
    name.value = name_val;
    category_id.value = id;

    Array.from(document.querySelector("#parent_id_input").options).forEach(function(option_element){
      console.log(option_element.text);
      console.log(name_val);
      if(option_element.text == parent_val){
        option_element.selected = true;
      }
      if(option_element.text == name_val){
        option_element.style.display = "none";
      }else{
        option_element.style.display = "";
      }
    });

    if (has_child == "true"){
      parent_id.disabled = true;
    }else{
      parent_id.disabled = false;
    }

  }
</script>

@endsection