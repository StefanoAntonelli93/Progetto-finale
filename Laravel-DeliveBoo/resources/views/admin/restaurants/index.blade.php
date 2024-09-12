<?php

// funzione per virgola alle categorie
$categoryNames = [];
foreach ($categories as $category) {
    $categoryNames[] = $category->name;
}
?>


@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col mt-4">
                {{-- message creazione nuovo ristorante --}}
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                {{-- se non esiste un collegamento tra admin e hotel allora sprono a crearne uno --}}
                @if (!$restaurant || !$restaurant->restaurant_name)
                    <div class="d-flex align-items-center justify-content-around border border-secondary rounded my-5">
                        <div class="p-5">
                            <h1 class="text-dark mt-3 ">Oooops {{ Auth::user()->name }} sembra che non ci siano
                                ristoranti...
                                Perchè
                                non ne
                                aggiungi
                                uno? </h1>
                        </div>

                        <div class="p-5"><button class="btn btn-success"><a
                                    href="{{ route('admin.restaurants.create') }}">Aggiungi
                                    Ristorante</a></button></div>
                    </div>
                @else
                    {{-- colonna foto --}}
                    <div class="d-flex justify-content-around border border-secondary rounded my-5">
                        @if ($restaurant->img)
                            <div class="img_ristorante col p-5 ">
                                <img class="rounded" src="{{ asset('storage/' . $restaurant->img) }}" alt="">
                            </div>
                        @endif
                        {{-- colonna info --}}
                        <div class="d-flex flex-column justify-content-between col py-5 pe-5">
                            <div class="text-center">
                                <h1>{{ $restaurant->restaurant_name }}</h1>
                                <p class="ms-1">Creato il: {{ $restaurant->created_at }}</p>
                            </div>
                            <div class="piatti">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h2>Non ci sono piatti disponibili</h2>
                                    </div>

                                    <div>
                                        <button class="btn btn-primary"><a href="{{ route('admin.plates.index') }}">Aggiungi
                                                Piatto</a></button>
                                    </div>

                                </div>

                                <h3>Qua ci va il carosello con le immagini dei piatti</h3>
                            </div>
                            <div class="categoria">
                                <p>Categorie: {{ implode(', ', $categoryNames) }}</p>
                            </div>
                            <div class="d-flex gap-3 justify-content-center">
                                <div>
                                    {{-- visualizza dettagli --}}
                                    <button class="btn btn-info"><a
                                            href="{{ route('admin.restaurants.show', $restaurant) }}">Dettagli</a></button>
                                </div>

                                <div>
                                    <button class="btn btn-warning"><a
                                            href="{{ route('admin.restaurants.edit', $restaurant) }}">Modifica</a></button>
                                </div>
                                {{-- modifica --}}
                                <div>
                                    {{-- cancella --}}
                                    <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Elimina</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
