<?php

// funzione per virgola alle categorie
$categoryNames = [];
foreach ($categories as $category) {
    $categoryNames[] = $category->name;
}

?>


@extends('layouts.app')


@section('content')
    <div class="container py-5">
        <div class="content d-flex justify-content-between align-items-center">
            <h2 class="py-3">Dettagli del tuo ristorante</h2>
            {{-- vai a index --}}
            <a href="{{ route('admin.restaurants.index') }}"><button class="btn btn-primary btn-sm">Torna ai
                    ristoranti</button></a>
        </div>


        @if ($restaurant)
            @if ($restaurant->img)
                <div>
                    <img class="w-50" src="{{ asset('storage/' . $restaurant->img) }}"
                        alt="{{ $restaurant->restauran_name }}">
                </div>
            @endif
            <p>Nome ristorante: {{ $restaurant->restaurant_name }}</p>
            <p>Indirizzo: {{ $restaurant->address }}</p>
            <p>Numero di telefono: {{ $restaurant->phone_number }}</p>
            <p>Descrizione: {{ $restaurant->description }}</p>
            <p>Partita IVA: {{ $restaurant->p_iva }}</p>


            <p>Categorie: {{ implode(', ', $categoryNames) }}</p>
        @else
            <p>Ristorante non trovato.</p>
        @endif

    </div>
@endsection
