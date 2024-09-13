@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <div class="border border-secondary rounded my-5 p-5">
            <div class="content d-flex justify-content-between align-items-center">
                <h2 class="py-3">Registra nuovo piatto </h2>
                {{-- Vai a index --}}
                <a href="{{ route('admin.plates.index') }}">
                    <button class="btn btn-primary btn-sm">Torna ai tuoi piatti</button>
                </a>
            </div>
            {{-- Includo errors.blade.php per mostrare errori --}}
            @include('shared.errors')

            {{-- Form --}}
            <form action="{{ route('admin.plates.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <p class="text-secondary">i campi contrassegnati con * sono obbligatori</p>
                <div class="mb-3">
                    <label for="restaurant-name" class="form-label">Nome piatto *</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Ingredienti *</label>
                    <textarea rows="4" class="form-control" id="ingredients" name="ingredients">{{ old('ingredients') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="restaurant-name" class="form-label">Allergerni</label>
                    <input type="text" class="form-control" id="allergenes" name="allergenes"
                        value="{{ old('allergenes') }}">
                </div>


                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea rows="4" class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Prezzo *</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price"
                        value="{{ old('price') }}" required>
                </div>


                {{-- File input --}}
                <div class="mb-3">
                    <img id="img-preview" src="#" alt="Anteprima Immagine"
                        style="display: none; margin-top: 10px; max-width: 300px;">
                    <label for="img" class="form-label">Immagine piatto</label>
                    <input class="form-control" type="file" id="img" name="img">
                </div>
                <div class="d-flex justify-content-end"><button type="submit" class="btn btn-primary">Crea
                        piatto</button></div>

            </form>
        @endsection

    </div>
