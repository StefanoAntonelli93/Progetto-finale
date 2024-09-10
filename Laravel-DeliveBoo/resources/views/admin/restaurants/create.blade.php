@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <div class="content d-flex justify-content-between align-items-center">
            <h2 class="py-3">Crea nuovo progetto </h2>
            {{-- vai a index --}}
            <a href="{{ route('admin.restaurants.index') }}"><button class="btn btn-primary btn-sm">Torna ai tuoi
                    ristoranti</button></a>
        </div>
        {{-- includo errors.blade.php per mostrare errori --}}
        {{-- @include('shared.errors') --}}

        {{-- form --}}
        <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="restaurant-name" class="form-label">Nome ristorante</label>
                <input type="text" class="form-control" id="restaurant-name" name="restaurant_name">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Telefono ristorante</label>
                <input type="number" class="form-control" id="phone_number" name="phone_number">
            </div>
            <div class="mb-3">
                <label for="p_iva" class="form-label">Partita IVA</label>
                <input type="number" class="form-control" id="p_iva" name="p_iva">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea rows="4" type="text" class="form-control" id="description" name="description"></textarea>
            </div>
            {{-- file input --}}
            <div class="mb-3">
                <label for="img" class="form-label">Immagine ristorante</label>
                <input class="form-control" type="file" id="img" name="img">
            </div>

            <button type="submit" class="btn btn-primary">Crea progetto </button>
            {{-- type form select --}}
            {{-- <div class="mb-3">
                <label for="type-content" class="form-label">Tipo di progetto</label>
                <select class="form-select" name="type_id">
                    <option value="">Nome progetto</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" @if (old('type_id') == $type->id) selected @endif>
                            {{ $type->name }}</option>
                    @endforeach

                </select>
            </div> --}}
        @endsection
