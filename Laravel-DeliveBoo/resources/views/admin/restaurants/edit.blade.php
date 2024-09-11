@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <div class="content d-flex justify-content-between align-items-center">
            @include('shared.errors')
            <h2 class="py-3">Modifica ristorante {{ $restaurant->restaurant_name }}</h2>
            {{-- vai a index --}}
            <a href="{{ route('admin.restaurants.index') }}"><button class="btn btn-primary btn-sm">Torna ai tuoi
                    ristoranti</button></a>
        </div>
        <form action="{{ route('admin.restaurants.update', $restaurant) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="restaurant-name" class="form-label">Nome ristorante</label>
                <input type="text" class="form-control" id="restaurant-name" name="restaurant_name"
                    value="{{ old('restaurant_name', $restaurant->restaurant_name) }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" class="form-control" id="address" name="address"
                    value="{{ old('address', $restaurant->address) }}">
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Telefono ristorante</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number"
                    value="{{ old('phone_number', $restaurant->phone_number) }}">
            </div>
            <div class="mb-3">
                <label for="p_iva" class="form-label">Partita IVA</label>
                <input type="number" class="form-control" id="p_iva" name="p_iva"
                    value="{{ old('p_iva', $restaurant->p_iva) }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea rows="4" type="text" class="form-control" id="description" name="description">{{ old('description', $restaurant->description) }}"</textarea>
            </div>
            {{-- file input --}}
            <div class="mb-3">
                <img id="img-preview" src="#" alt="Anteprima Immagine"
                    style="display: none; margin-top: 10px; max-width: 300px;">
                <input class="form-control" type="file" id="img" name="img">
            </div>

            <button type="submit" class="btn btn-primary">Modifica Ristorante</button>
        @endsection
