@extends('layouts.app')


@section('content')
    <div class="container my-5 orange-border p-3 card-shadow">
        <div class="content d-flex justify-content-between align-items-center">
            <h1 class="py-3">Dettagli del tuo ristorante</h1>
            {{-- vai a index --}}
            <a href="{{ route('admin.restaurants.index') }}"><button class="btn btn-primary btn-md button-shadow">Torna ai
                    ristoranti</button></a>
        </div>

        @if ($restaurant)
            <div class="conatiner-sm">
                <div class="row">
                    <div class="col-xxl-6 col-md-12">
                        @if ($restaurant->img)
                            <div class="d-flex h-100">
                                <img class="w-100" src="{{ asset('storage/' . $restaurant->img) }}"
                                    alt="{{ $restaurant->restauran_name }}">
                            </div>
                    </div>
                    <div class="col-xxl-6 col-md-12">
        @endif
        <div class="d-flex justify-content-between  flex-wrap">
            <h2>Nome ristorante: </h2>
            <h2>{{ $restaurant->restaurant_name }}</h2>
        </div>
        <hr class="orange-border my-2">
        <div class="d-flex justify-content-between  flex-wrap">
            <h3>Indirizzo:</h3>
            <h3>{{ $restaurant->address }}</h3>
        </div>
        <hr class="orange-border my-2">
        <div class="d-flex justify-content-between">
            <h3>Numero di telefono:</h3>
            <h3>{{ $restaurant->phone_number }}</h3>
        </div>
        <hr class="orange-border my-2">
        <div class="d-flex justify-content-between flex-wrap">
            <h3 class="me-2">Descrizione:</h3>
            <h3 class="text-end">{{ $restaurant->description }}</h3>
        </div>
        <hr class="orange-border my-2">
        <div class="d-flex justify-content-between">
            <h3>Partita IVA:</h3>
            <h3>{{ $restaurant->p_iva }}</h3>
        </div>
        <hr class="orange-border my-2">
        <div class="d-flex justify-content-between">
            <h3>Categorie:</h3>
            <h3>{{ implode(', ', $restaurant->categories->pluck('name')->toArray()) }}</h3>
        </div>
        {{-- modifica --}}
        <div>
            <button class="btn btn-warning mt-3 button-shadow"><a
                    href="{{ route('admin.restaurants.edit', $restaurant) }}">Modifica</a></button>
        </div>
    </div>
    </div>
    </div>
@else
    <h1>Ristorante non trovato.</h1>
    @endif
    </div>
@endsection
