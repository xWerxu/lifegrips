@extends('layouts.app')

@section('content')
    
<div class="container">
    <h1 class="display-3">Witaj {{ $user->email }}</h1>
    <h1 class="display-6">Oto Twój profil:</h1>
    <br>
    <div class="row">
        <div class="col">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Dane kontaktowe i adres dostawy</h5>
                    <hr>
                    <form method="POST" action="{{ route('user.update') }}" class="justify-content-md-center">
                        <fieldset disabled id="form-fieldset">
                        @method('PUT')
                        @csrf
                        <div class="w-50 mx-auto">
                        <label for="first_name" class="form-label">Imię</label>
                        <input id="first_name" name="first_name" type="text" class="form-control disabled text-center" value="{{ $user->first_name }}">
                        </div>
                        <br>
                        <div class="w-50 mx-auto">
                            <label for="last_name" class="form-label">Nazwisko</label>
                            <input id="last_name" name="last_name" type="text" class="form-control text-center" value="{{ $user->last_name }}">
                        </div>
                        <br>
                        <div class="w-50 mx-auto">
                            <label for="phone_number" class="form-label">Numer telefonu</label>
                            <input id="phone_number" name="phone_number" type="text" class="form-control text-center" value="{{ $user->phone_number }}">
                        </div>
                        <br>
                        <div class="w-50 mx-auto">
                            <label for="city" class="form-label">Miejscowość</label>
                            <input id="city" name="city" type="text" class="form-control text-center" value="{{ $user->city }}">
                        </div>
                        <br>
                        <div class="w-50 mx-auto">
                            <label for="address" class="form-label">Adres</label>
                            <input id="address" name="address" type="text" class="form-control text-center" value="{{ $user->address }}">
                        </div>
                        <br>
                        <div class="w-50 mx-auto">
                            <label for="postal_code" class="form-label">Kod pocztowy</label>
                            <input id="postal_code" name="postal_code" type="text" class="form-control text-center" value="{{ $user->postal_code }}">
                        </div>
                        </fieldset>
                        <br>
                        <div class="w-50 mx-auto">
                            <button class="btn btn-warning float-start" id="edit-button" type="button" onclick="startForm()">Edytuj</button>
                            <button class="btn btn-danger visually-hidden float-start" id="cancel-button" type="button" onclick="cancelForm()">Anuluj</button>
                            <button class="btn btn-primary visually-hidden float-end" id="save-button" type="submit" id="save-butotn" name="save_changes">Zapisz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
        </div>
    </div>
</div>

<script>
    var first_name, last_name, phone_number, city, address, postal_code;

    function startForm(){
        first_name = document.getElementById("first_name").value;
        last_name = document.getElementById("last_name").value;
        phone_number = document.getElementById("phone_number").value;
        city = document.getElementById("city").value;
        address = document.getElementById("address").value;
        postal_code = document.getElementById("postal_code").value;

        let fieldset = document.getElementById("form-fieldset");
        let editButton = document.getElementById("edit-button");
        let saveButton = document.getElementById("save-button");
        let cancelButton = document.getElementById("cancel-button");

        fieldset.disabled = false;
        editButton.classList.add("visually-hidden");
        saveButton.classList.remove("visually-hidden");
        cancelButton.classList.remove("visually-hidden");
    }

    function cancelForm(){
        document.getElementById("first_name").value = first_name;
        document.getElementById("last_name").value = last_name;
        document.getElementById("phone_number").value = phone_number;
        document.getElementById("city").value = city;
        document.getElementById("address").value = address;
        document.getElementById("postal_code").value = postal_code;

        let fieldset = document.getElementById("form-fieldset");
        let editButton = document.getElementById("edit-button");
        let saveButton = document.getElementById("save-button");
        let cancelButton = document.getElementById("cancel-button");

        fieldset.disabled = true;
        editButton.classList.remove("visually-hidden");
        saveButton.classList.add("visually-hidden");
        cancelButton.classList.add("visually-hidden");
    }
</script>

@endsection
