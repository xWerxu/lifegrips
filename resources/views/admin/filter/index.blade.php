@extends('layouts.admin')

@section('content')
<h1><i class="bi bi-list-ul mt-0 mt-md-5 me-2"></i>Filtry</h1>
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
  <div class="col-lg-6 col-sm-12">
    <div class="text-center">
      <h1 class="fw-light">Dodaj nowy filtr</h1>
      <br>
      <form class="form" method="post" action="{{ route('admin.filter.create') }}">
        @csrf
        <label class="form-label">Nazwa</label>
        <input type="text" class="form-control" required name="name"><br>
        <label class="form-abel">Kategorie</label>
        <div class="row text-start">
            @foreach ($categories as $category)
                <div class="col-lg-4 col-sm-6">
                    <div class="form-check ms-3">
                        <label class="form-check-label" for="{{ $category->category_id }}">{{ $category->name }}</label>
                        <input class="form-check-input" type="checkbox" value="{{ $category->category_id }}" id="{{ $category->category_id }}" name="categories[]">
                    </div>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary btn-lg"><i class="me-2 bi bi-plus-circle"></i>Dodaj</button>
      </form>
    </div>
  </div>
  <div class="col-lg-6 col-sm-12">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nazwa</th>
          <th scope="col">Akcje</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($filters as $filter)
          <tr>
             <td scope="col" class="w-25">{{ $filter->id }}</td>
             <td class="w-50" id="name{{ $filter->id }}">{{ $filter->name }}</td>
             <td>
                <div class="btn-group">
                    <button class="btn btn-warning" onclick="edit({{ $filter->id }})" data-bs-toggle="modal" data-bs-target="#formModal"><i class="me-2 bi bi-pencil"></i>Edytuj</button>
                    <form method="POST" action="{{ route('admin.filter.delete') }}" onsubmit="return confirm('Czy na pewno chcesz usunąć filtr {{ $filter->name }}?');">
                      @csrf
                      @method('delete')
                      <input type="hidden" name="filter_id" value="{{ $filter->id }}">
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
        <form class="form" method="POST" action="{{ route('admin.filter.update') }}">
          @csrf
          @method('PUT')
          <input type="hidden" id="filter_id_input" name="filter_id" value="">
          <label for="name_input" class="form-label">Nazwa</label>
          <input class="form-control" type="text" id="name_input" name="name" value="">
          <br>
          <label class="form-label">Kategorie</label>
            <div class="row col-4-lg col-12-sm">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-check ms-3">
                            <label class="form-check-label" for="input{{ $category->category_id }}">{{ $category->name }}</label>
                            <input class="form-check-input" type="checkbox" value="{{ $category->category_id }}" id="input{{ $category->category_id }}" name="input_categories[]">
                        </div>
                    </div>
                @endforeach
            </div>
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
    let checkboxes = document.getElementsByName('input_categories[]');
    for (let i = 0, n=checkboxes.length; i<n; i++){
        checkboxes[i].checked = false;
    }


    $.ajax({
        url: "{{ route('api.find-filter') }}",
        type: 'get',
        data: {
            "filter_id": id
        }
    }).done(function(data){
        var all = JSON.parse(data);
        for (const category of all){
            checkbox = document.getElementById('input'+category.category_id);
            checkbox.checked = true;
        }
    });

    const title = document.getElementById("formModalLabel");
    const filter_id = document.getElementById("filter_id_input");
    const name = document.getElementById("name_input");

    let name_val = document.getElementById("name" + id).innerHTML;

    title.innerHTML = "Edytuj " + name_val;
    name.value = name_val;
    filter_id.value = id;
  }
</script>

@endsection