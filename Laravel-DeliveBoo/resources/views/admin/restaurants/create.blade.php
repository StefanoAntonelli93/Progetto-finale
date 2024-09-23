@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <div class=" rounded my-5 p-5 orange-border card-shadow">
            <div class="content d-flex justify-content-between align-items-center">
                <h2 class="py-3">Registra nuovo ristorante </h2>
                {{-- Vai a index --}}
                <a href="{{ route('admin.restaurants.index') }}">
                    <button class="btn btn-primary btn-md button-shadow">Torna ai tuoi ristoranti</button>
                </a>
            </div>
            {{-- Includo errors.blade.php per mostrare errori --}}
            @include('shared.errors')

            {{-- Form --}}
            <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <p class="text-secondary">I campi contrassegnati con * sono obbligatori</p>
                <div class="mb-3">
                    <label for="restaurant-name" class="form-label">Nome ristorante *</label>
                    <input type="text" class="form-control" id="restaurant-name" name="restaurant_name" required
                        value="{{ old('restaurant_name') }}">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Indirizzo *</label>
                    <input type="text" class="form-control" id="address" name="address" required
                        value="{{ old('address') }}">
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Telefono ristorante *</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                        pattern="^(\+?\d{1,4}[\s-]?)?(\(?\d{1,4}\)?[\s-]?)?[\d\s-]{5,15}$" value="{{ old('phone_number') }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="p_iva" class="form-label">Partita IVA *</label>
                    <input type="text" class="form-control" id="p_iva" minlength="11" maxlength="11" required
                        name="p_iva" placeholder="(11 numeri)" value="{{ old('p_iva') }}">
                </div>
                <!-- Type -->
                <div class="mb-3 ">
                    <label for="category">Categoria: </label>
                    <div class="d-flex flex-wrap">
                        @foreach ($categories as $category)
                            <div class="col-4 d-flex flex-column justfy-content-center align-items-center mb-3">
                                <span class="mb-1">{{ $category->name }}</span>
                                <input class="checkbox" name="categories[]" type="checkbox" value="{{ $category->id }}"
                                    {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
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
                <div class="d-flex justify-content-end"><button type="submit" class="btn btn-primary button-shadow">Crea
                        Ristorante</button></div>

            </form>
        @endsection

    </div>
