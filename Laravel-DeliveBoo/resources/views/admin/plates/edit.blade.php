@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <div class="content d-flex justify-content-between align-items-center">
            <h2 class="py-3">Modifica piatto {{ $plate->name }}</h2>
            {{-- vai a index --}}
            <a href="{{ route('admin.plates.index') }}"><button class="btn btn-primary btn-sm">Torna ai tuoi
                    piatti</button></a>
        </div>
        <form action="{{ route('admin.plates.update', $plate) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <p class="text-secondary">i campi contrassegnati con * sono obbligatori</p>
            @include('shared.errors')
            <div class="mb-3">
                <label for="name" class="form-label">Nome piatto *</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $plate->name) }}">
            </div>
            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredienti *</label>
                <textarea rows="4" type="text" class="form-control" id="ingredients" name="ingredients">{{ old('ingredients', $plate->ingredients) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="allergenes" class="form-label">Allergeni</label>
                <input type="text" class="form-control" id="allergenes" name="allergenes"
                    value="{{ old('allergenes', $plate->allergenes) }}">
            </div>


            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea rows="4" type="text" class="form-control" id="description" name="description">{{ old('description', $plate->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Prezzo *</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price"
                    value="{{ old('price') }}" required>
            </div>

            {{-- file input --}}
            <div class="mb-3">
                <img id="img-preview" src="#" alt="Anteprima Immagine"
                    style="display: none; margin-top: 10px; max-width: 300px;">
                <input class="form-control" type="file" id="img" name="img">
            </div>

            <button type="submit" class="btn btn-primary">Modifica Ristorante</button>
        @endsection
