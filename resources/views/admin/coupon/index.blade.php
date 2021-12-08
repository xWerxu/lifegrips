@extends('layouts.admin')

@section('content')
<h1><i class="bi bi-list-ul mt-0 mt-md-5 me-2"></i>Kody rabatowe</h1>
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
      <h1 class="fw-light">Dodaj kod rabatowy</h1>
      <br>
      <form class="form" method="post" action="{{ route('admin.coupon.create') }}">
        @csrf
        <label class="form-label">Kod</label>
        <input type="text" class="form-control" required name="coupon"><br>
        <br>
        <label class="form-label">Zniżka (%)</label>
        <input class="form-control" type="text" name="promotion" pattern="^\d+(.\d{1,2})?$">
        <br>
        <div class="form-check text-start">
            <label class="form-check-label" for="shipment">Darmowa dostawa</label>
            <input class="form-check-input" type="checkbox" id="shipment" name="shipment">
        </div>
        <div class="form-check text-start">
          <label class="form-check-label" for="available">Aktywny</label>
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
          <th scope="col">Kod</th>
          <th scope="col">Zniżka (%)</th>
          <th scope="col">Darmowa dostawa</th>
          <th scope="col">Aktywny</th>
          <th scope="col">Akcje</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($coupons as $coupon)
          <tr>
              <th scope="row">{{ $coupon->id }}</th>
              <td id="coupon{{ $coupon->id }}"> {{ $coupon->coupon }} </td>
              <td id="promotion{{ $coupon->id }}"> {{ $coupon->promotion }} </td>
              <td id="shipment{{ $coupon->id }}"> {{ ($coupon->shipment == 1) ? 'Tak' : 'Nie' }} </td>
              <td id="available{{ $coupon->id }}"> {{ ($coupon->available == 1) ? 'Aktywny' : 'Nieaktywny' }} </td>
              <td>
                  <div class="btn-group">
                      <button class="btn btn-warning" onclick="edit({{ $coupon->id }})" data-bs-toggle="modal" data-bs-target="#formModal"><i class="me-2 bi bi-pencil"></i>Edytuj</button>
                      <form method="POST" action="{{ route('admin.coupon.delete') }}" onsubmit="return confirm('Czy na pewno chcesz usunąć kody {{ $coupon->coupon }}?');">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="coupon_id" value="{{ $coupon->id }}">
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
        <form class="form" method="POST" action="{{ route('admin.coupon.update') }}">
          @csrf
          @method('PUT')
          <input type="hidden" id="coupon_id_input" name="coupon_id" value="">
          <label for="coupon_input" class="form-label">Kod</label>
          <input class="form-control" type="text" id="coupon_input" name="coupon" value="">
          <br>
          <label class="form-label">Zniżka (%)</label>
          <input class="form-control" id="promotion_input" type="text" name="promotion" pattern="^\d+(.\d{1,2})?$">
          <br>
          <div class="form-check text-start">
            <label class="form-check-label" for="shipment_input">Darmowa dostawa</label>
            <input class="form-check-input" type="checkbox" id="shipment_input" name="shipment">
          </div>
          <div class="form-check text-start">
            <label class="form-check-label" for="available_input">Aktywny</label>
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
    const coupon_id = document.getElementById("coupon_id_input");
    const promotion = document.getElementById("promotion_input");
    const coupon = document.getElementById("coupon_input");
    const available = document.getElementById("available_input");
    const shipment = document.getElementById("shipment_input");

    let available_val = document.getElementById("available" + id).innerHTML;
    let shipment_val = document.getElementById("shipment" + id).innerHTML;
    let coupon_val = document.getElementById("coupon" + id).innerHTML;
    let promotion_val = document.getElementById("promotion" + id).innerHTML;
    promotion_val = promotion_val.replace(/\s/g, '');
    coupon_val = coupon_val.replace(/\s/g, '');
    available_val = available_val.replace(/\s/g, '');
    shipment_val = shipment_val.replace(/\s/g, '');

    title.innerHTML = "Edytuj " + coupon_val;
    coupon.value = coupon_val;
    coupon_id.value = id;
    promotion.value = promotion_val;
    if (available_val == "Aktywny"){
      available.checked = true;
    }else{
      available.checked = false;
    }
    console.log(available_val);

    if (shipment_val == "Tak"){
      shipment.checked = true;
    }else{
      shipment.checked = false;
    }
    console.log(shipment_val);

  }
</script>

@endsection