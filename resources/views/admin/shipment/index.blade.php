@extends('layouts.admin')

@section('content')
<h1><i class="bi bi-list-ul mt-0 mt-md-5"></i>Opcje dostawy</h1>
<hr class="divider">
@if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
@endif
@if ($errors->any())
  <div class="alert alert-danger">
    {{ implode('.', $errors->all(':message')) }}
  </div>
@endif
<div class="row">
  <div class="col-lg-4 col-sm-12">
    <div class="text-center">
      <h1 class="fw-light">Dodaj opcję dostawy</h1>
      <br>
      <form class="form" method="post" action="{{ route('admin.shipment.create') }}">
        @csrf
        <label class="form-label">Nazwa</label>
        <input type="text" class="form-control" required name="name"><br>
        <br>
        <label class="form-label">Koszt</label>
        <input class="form-control" type="text" name="price" pattern="^\d+(.\d{1,2})?$">
        <br>
        <div class="form-check text-start">
          <label class="form-check-label" for="available">Dostępna</label>
          <input class="form-check-input" type="checkbox" checked id="available" name="available">
       </div>
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
          <th scope="col">Koszt (zł)</th>
          <th scope="col">Dostępność</th>
          <th scope="col">Akcje</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($shipments as $shipment)
          <tr>
              <th scope="row">{{ $shipment->id }}</th>
              <td id="name{{ $shipment->id }}"> {{ $shipment->name }} </td>
              <td id="price{{ $shipment->id }}"> {{ $shipment->price }} </td>
              <td id="available{{ $shipment->id }}"> {{ ($shipment->available == 1) ? 'Dostępna' : 'Niedostępna' }} </td>
              <td>
                  <div class="btn-group">
                      <button class="btn btn-warning" onclick="edit({{ $shipment->id }})" data-bs-toggle="modal" data-bs-target="#formModal"><i class="me-2 bi bi-pencil"></i>Edytuj</button>
                      <form method="POST" action="{{ route('admin.shipment.delete') }}" onsubmit="return confirm('Czy na pewno chcesz usunąć opcję {{ $shipment->name }}?');">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="shipment_id" value="{{ $shipment->id }}">
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
        <form class="form" method="POST" action="{{ route('admin.shipment.update') }}">
          @csrf
          @method('PUT')
          <input type="hidden" id="shipment_id_input" name="shipment_id" value="">
          <label for="name_input" class="form-label">Opcja dostawy</label>
          <input class="form-control" type="text" id="name_input" name="name" value="">
          <br>
          <label class="form-label">Koszt</label>
          <input class="form-control" id="price_input" type="text" name="price" pattern="^\d+(.\d{1,2})?$">
          <br>
          <div class="form-check text-start">
            <label class="form-check-label" for="available_input">Dostępna</label>
            <input class="form-check-input" type="checkbox" checked id="available_input" name="available">
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
    const title = document.getElementById("formModalLabel");
    const shipment_id = document.getElementById("shipment_id_input");
    const price = document.getElementById("price_input");
    const name = document.getElementById("name_input");
    const available = document.getElementById("available_input");

    let available_val = document.getElementById("available" + id).innerHTML;
    let name_val = document.getElementById("name" + id).innerHTML;
    let price_val = document.getElementById("price" + id).innerHTML;
    price_val = price_val.replace(/\s/g, '');
    name_val = name_val.replace(/\s/g, '');
    available_val = available_val.replace(/\s/g, '');

    title.innerHTML = "Edytuj " + name_val;
    name.value = name_val;
    shipment_id.value = id;
    price.value = price_val;
    if (available_val == "Dostępna"){
      available.checked = true;
    }else{
      available.checked = false;
    }

  }
</script>

@endsection