@extends('layouts.app')


@section('content')
    <div class="container py-5">
        <div class="content d-flex justify-content-between align-items-center">
            <h2 class="py-3">Dettagli piatto</h2>
            {{-- vai a index --}}
            <a href="{{ route('admin.plates.index') }}"><button class="btn btn-primary btn-sm">Torna ai
                    tuoi piatti</button></a>
        </div>


        @if ($plate)
            @if ($plate->img)
                <div>
                    <img class="w-50" src="{{ asset('storage/' . $plate->img) }}" alt="{{ $plate->name }}">
                </div>
            @endif
            <p>Nome piatto: {{ $plate->name }}</p>
            <p>Ingredienti: {{ $plate->ingredients }}</p>
            <p>Allergeni: {{ $plate->allergenes }}</p>
            <p>Descrizione: {{ $plate->description }}</p>
            <p>Prezzo: {{ $plate->price }}</p>





            {{-- modifica --}}
            <div>
                <button class="btn btn-warning"><a href="{{ route('admin.plates.edit', $plate) }}">Modifica</a></button>
            </div>
        @else
            <p>Piatto non trovato.</p>
        @endif

    </div>
@endsection
