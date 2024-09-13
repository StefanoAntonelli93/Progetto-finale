@extends('layouts.app')


@section('content')
    <div class="container py-5">
        <div class="content d-flex justify-content-between align-items-center">
            <h2 class="py-3">Dettagli piatto</h2>
            {{-- vai a index --}}
            <a href="{{ route('admin.plates.index') }}"> <button class="btn btn-primary btn-md">Torna ai tuoi
                    piatti</button></a>
        </div>


        @if ($plate)
            <div class="container-sm">
                <div class="row">
                    <div class="col-6">
                        @if ($plate->img)
                            <div>
                                <img class="w-100" src="{{ asset('storage/' . $plate->img) }}" alt="{{ $plate->name }}">
                            </div>
                    </div>
                    <div class="col-6">
        @endif
        <p>Nome piatto: {{ $plate->name }}</p>
        <p>Ingredienti: {{ $plate->ingredients }}</p>
        <p>Allergeni: {{ $plate->allergenes }}</p>
        <p>Descrizione: {{ $plate->description }}</p>
        <p>Prezzo: {{ $plate->price }}</p>
        {{-- modifica --}}
        <div>
            <a href="{{ route('admin.plates.edit', $plate) }}"><button class="btn btn-warning mt-3">Modifica</button></a>
        </div>
    </div>
    </div>







    </div>
@else
    <p>Piatto non trovato.</p>
    @endif

    </div>
@endsection
