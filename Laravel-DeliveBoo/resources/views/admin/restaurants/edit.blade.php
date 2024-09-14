@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <div class="content d-flex justify-content-between align-items-center">
            @include('shared.errors')
            <h2 class="py-3">Modifica ristorante {{ $restaurant->restaurant_name }}</h2>
            {{-- vai a index --}}
            <a href="{{ route('admin.restaurants.index') }}"><button class="btn btn-primary btn-md">Torna ai tuoi
                    ristoranti</button></a>
        </div>
        <form action="{{ route('admin.restaurants.update', $restaurant) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <p class="text-secondary">I campi contrassegnati con * sono obbligatori</p>
            <div class="mb-3">
                <label for="restaurant-name" class="form-label">Nome ristorante *</label>
                <input type="text" class="form-control" id="restaurant-name" name="restaurant_name" required
                    value="{{ old('restaurant_name', $restaurant->restaurant_name) }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo *</label>
                <input type="text" class="form-control" id="address" name="address" required
                    value="{{ old('address', $restaurant->address) }}">
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Telefono ristorante *</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" required
                    pattern="^(\+?\d{1,4}[\s-]?)?(\(?\d{1,4}\)?[\s-]?)?[\d\s-]{5,15}$"
                    value="{{ old('phone_number', $restaurant->phone_number) }}">
            </div>
            <div class="mb-3">
                <label for="p_iva" class="form-label">Partita IVA *</label>
                <input type="number" class="form-control" id="p_iva" name="p_iva" required pattern="^\d{11}$"
                    value="{{ old('p_iva', $restaurant->p_iva) }}">
            </div>
            <div class="d-flex flex-wrap">
                @foreach ($categories as $category)
                    <div class="col-4 d-flex flex-column justfy-content-center align-items-center mb-3">
                        <span class="mb-1">{{ $category->name }}</span>
                        {{-- techs[] le parentesi permettono di inviare un array di checkbox se selezionato piu di 1 --}}
                        <input class="checkbox" name="categories[]" type="checkbox" value="{{ $category->id }}"
                            {{ $restaurant->categories->contains($category) ? 'checked' : '' }}>
                        {{-- verifico se i tech selezionati prima sono presenti nell'array techs, setto il controllo old a [] per evitare l'errore iniziale --}}
                    </div>
                @endforeach
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea rows="4" type="text" class="form-control" id="description" name="description">{{ old('description', $restaurant->description) }}</textarea>
            </div>
            {{-- file input --}}
            <div class="mb-3">
                <img class="mb-3" id="img-preview" src="{{ asset('storage/' . $restaurant->img) }}"
                    alt="Anteprima Immagine" style=" max-width: 300px; max-height: 200px">
                <input class="form-control" type="file" id="img" name="img">
            </div>

            <button type="submit" class="btn btn-primary">Modifica Ristorante</button>
        @endsection
