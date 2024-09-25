@extends('layouts.app')


@section('content')
    <div class="container my-5 p-4 orange-border card-shadow">
        <div class="content d-flex justify-content-between align-items-center px-2">
            <h1 class="my-4">Dettagli piatto</h1>
            {{-- vai a index --}}
            <a href="{{ route('admin.plates.index') }}"> <button
                    class="btn btn-primary btn-md button-shadow gray-hover border-0">Torna
                    ai tuoi
                    piatti</button></a>
        </div>


        @if ($plate)
            <div class="container-sm">
                <div class="row">
                    @if ($plate->img)
                        <div class="col-lg-6 col-12-sm">
                            <img class="w-100 h-100 rounded" src="{{ asset('storage/' . $plate->img) }}"
                                alt="{{ $plate->name }}">
                        </div>
                        <div class="col-lg-6 col-12-sm mt-4 ">
                        @else
                            <div class="col-12 p-0">
                    @endif
                    <div class="d-flex justify-content-between">
                        <h2 class="me-3">Nome piatto: </h2>
                        <h2>{{ $plate->name }}</h2>
                    </div>
                    <hr class="orange-border my-2">
                    <div class="d-flex justify-content-between">
                        <h3 class="me-3">Ingredienti:</h3>
                        <h3>{{ $plate->ingredients }}</h3>
                    </div>
                    <hr class="orange-border my-2">
                    <div class="d-flex justify-content-between">
                        <h3 class="me-3">Allergeni:</h3>
                        <h3>{{ $plate->allergenes }}</h3>
                    </div>
                    <hr class="orange-border my-2">
                    <div class="d-flex justify-content-between">
                        <h3 class="me-3">Descrizione:</h3>
                        <h3>{{ $plate->description }}</h3>
                    </div>
                    <hr class="orange-border my-2">
                    <div class="d-flex justify-content-between">
                        <h3>Prezzo:</h3>
                        <h3>{{ $plate->price }}€</h3>
                    </div>

                    {{-- modifica --}}
                    <div>
                        <a href="{{ route('admin.plates.edit', $plate) }}"><button
                                class="btn btn-primary mt-3 button-shadow gray-hover border-0 text-light">Modifica</button></a>
                    </div>
                </div>
            </div>







    </div>
@else
    <p>Piatto non trovato.</p>
    @endif

    </div>
@endsection
