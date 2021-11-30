@extends('layouts.admin')

@section('content')
<h1><i class="bi bi-list-ul mt-0 mt-md-5"></i>Opcje płatności</h1>
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
      <h1 class="fw-light">Dodaj płatności</h1>
      <br>
      <form class="form" method="post" action="{{ route('admin.payment.create') }}">
        @csrf
        <label class="form-label">Nazwa</label>
        <input type="text" class="form-control" required name="name"><br>
        <br>
        <label class="form-label">Prowizja</label>
        <input class="form-control" type="text" name="fee" pattern="^\d+(.\d{1,2})?$">
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
          <th scope="col">Prowizja (zł)</th>
          <th scope="col">Dostępność</th>
          <th scope="col">Akcje</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($payments as $payment)
          <tr>
              <th scope="row">{{ $payment->id }}</th>
              <td id="name{{ $payment->id }}"> {{ $payment->name }} </td>
              <td id="fee{{ $payment->id }}"> {{ $payment->fee }} </td>
              <td id="available{{ $payment->id }}"> {{ ($payment->available == 1) ? 'Dostępna' : 'Niedostępna' }} </td>
              <td>
                  <div class="btn-group">
                      <button class="btn btn-warning" onclick="edit({{ $payment->id }})" data-bs-toggle="modal" data-bs-target="#formModal"><i class="me-2 bi bi-pencil"></i>Edytuj</button>
                      <form method="POST" action="{{ route('admin.payment.delete') }}" onsubmit="return confirm('Czy na pewno chcesz usunąć opcję {{ $payment->name }}?');">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="payment_id" value="{{ $payment->id }}">
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
        <form class="form" method="POST" action="{{ route('admin.payment.update') }}">
          @csrf
          @method('PUT')
          <input type="hidden" id="payment_id_input" name="payment_id" value="">
          <label for="name_input" class="form-label">Opcja płatności</label>
          <input class="form-control" type="text" id="name_input" name="name" value="">
          <br>
          <label class="form-label">Prowizja</label>
          <input class="form-control" id="fee_input" type="text" name="fee" pattern="^\d+(.\d{1,2})?$">
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
    const payment_id = document.getElementById("payment_id_input");
    const fee = document.getElementById("fee_input");
    const name = document.getElementById("name_input");
    const available = document.getElementById("available_input");

    let available_val = document.getElementById("available" + id).innerHTML;
    let name_val = document.getElementById("name" + id).innerHTML;
    let fee_val = document.getElementById("fee" + id).innerHTML;
    fee_val = fee_val.replace(/\s/g, '');
    name_val = name_val.replace(/\s/g, '');
    available_val = available_val.replace(/\s/g, '');

    title.innerHTML = "Edytuj " + name_val;
    name.value = name_val;
    payment_id.value = id;
    fee.value = fee_val;
    if (available_val == "Dostępna"){
      available.checked = true;
    }else{
      available.checked = false;
    }

  }
</script>

@endsection