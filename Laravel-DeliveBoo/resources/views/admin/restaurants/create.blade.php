@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <div class="content d-flex justify-content-between align-items-center">
            <h2 class="py-3">Registra nuovo ristorante </h2>
            {{-- Vai a index --}}
            <a href="{{ route('admin.restaurants.index') }}">
                <button class="btn btn-primary btn-sm">Torna ai tuoi ristoranti</button>
            </a>
        </div>

        {{-- Includo errors.blade.php per mostrare errori --}}
        @include('shared.errors')

        {{-- Form --}}
        <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <p class="text-secondary">i campi contrassegnati con * sono obbligatori</p>
            <div class="mb-3">
                <label for="restaurant-name" class="form-label">Nome ristorante *</label>
                <input type="text" class="form-control" id="restaurant-name" name="restaurant_name"
                    value="{{ old('restaurant_name') }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo *</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Telefono ristorante *</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number"
                    value="{{ old('phone_number') }}">
            </div>
            <div class="mb-3">
                <label for="p_iva" class="form-label">Partita IVA *</label>
                <input type="text" class="form-control" id="p_iva" name="p_iva" value="{{ old('p_iva') }}">
            </div>
            <!-- Type -->
            <div class="mb-3 ">
                <label for="category">Categoria: </label>
                <div class="d-flex flex-wrap">
                    @foreach ($categories as $category)
                        <div class="col-4 d-flex flex-column justfy-content-center align-items-center mb-3">
                            <span class="mb-1">{{ $category->name }}</span>
                            {{-- techs[] le parentesi permettono di inviare un array di checkbox se selezionato piu di 1 --}}
                            <input class="checkbox" name="categories[]" type="checkbox" value="{{ $category->id }}"
                                {{ in_array($category->id, old('category', [])) ? 'checked' : '' }}>{{-- verifico se i tech selezionati prima sono presenti nell'array techs, setto il controllo old a [] per evitare l'errore iniziale --}}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea rows="4" class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div>

            {{-- File input --}}
            <div class="mb-3">
                <img id="img-preview" src="#" alt="Anteprima Immagine"
                    style="display: none; margin-top: 10px; max-width: 300px;">
                <label for="img" class="form-label">Immagine ristorante</label>
                <input class="form-control" type="file" id="img" name="img">
            </div>

            <button type="submit" class="btn btn-primary">Crea Ristorante</button>
        </form>
    @endsection
