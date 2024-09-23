@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col mt-4">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <!-- link top-->
                <a id="top"></a>
                <div>
                    <a href="{{ route('admin.restaurants.index') }}"> <button
                            class="btn btn-primary gray-hover border-0 button-shadow">Torna
                            Indietro</button></a>
                </div>
                <div class="d-flex justify-content-around orange-border card-shadow rounded my-5">
                    {{-- colonna info --}}
                    <div class="d-flex flex-column justify-content-between col">
                        <div class="piatti p-5">
                            @if ($plates->isEmpty())
                                <div
                                    class="d-flex align-items-center justify-content-around orange-border button-shadow rounded my-5">
                                    <div class="p-5">
                                        <h1 class="text-dark">Sembra che non ci siano piatti, perchè non ne
                                            aggiungi
                                            uno?</h1>
                                        <div class="text-center mt-5">
                                            <a href="{{ route('admin.plates.create') }}"><button
                                                    class="btn deliveboo-orange-background text-light gray-hover border-0 button-shadow">
                                                    Aggiungi
                                                    Piatto</button></a>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-between mb-5">
                                        <h1>Tutti i Piatti del Ristorante</h1>
                                        <a href="{{ route('admin.plates.create') }}">
                                            <button
                                                class="btn deliveboo-orange-background gray-hover border-0 button-shadow text-light">
                                                Aggiungi
                                                Piatto</button></a>
                                    </div>
                                    <div>
                                        @foreach ($plates as $plate)
                                            <div {{-- se piatto non è disponibile allora la card ha opacità --}}
                                                class="orange-border button-shadow rounded my-5 {{ $plate->available ? '' : 'opacity-50' }} ">
                                                <div class="container p-4">
                                                    <div class="row">
                                                        @if ($plate->img)
                                                            <div class="col-lg-6 col-sm-12 ">
                                                                <img class="rounded w-100 h-100"
                                                                    src="{{ asset('storage/' . $plate->img) }}"
                                                                    alt="{{ $plate->name }}">

                                                            </div>
                                                        @endif
                                                        @if ($plate->img)
                                                            <div
                                                                class="col-lg-6 col-sm-12 d-flex flex-column justify-content-between py-4">
                                                            @else
                                                                <div
                                                                    class="col-12 d-flex flex-column justify-content-between">
                                                        @endif
                                                        @if (!$plate->available)
                                                            <h2 class="text-danger text-center ">Non
                                                                Disponibile</h2>
                                                        @endif
                                                        <div class="d-flex flex-column justify-content-between">
                                                            <h2>{{ $plate->name }}</h2>
                                                            <hr class="orange-border my-2">
                                                            <div>
                                                                <h3 class="mb-3">{{ $plate->description }}</h3>
                                                                <hr class="orange-border my-2">
                                                                <h3 class="mb-3">Prezzo: {{ $plate->price }}€</h3>
                                                            </div>
                                                            <div class="d-flex gap-3 justify-content-end">
                                                                <div>
                                                                    {{-- visualizza dettagli --}}
                                                                    <a href="{{ route('admin.plates.show', $plate) }}"><button
                                                                            class="btn btn-info gray-hover border-0 button-shadow">Dettagli</button></a>
                                                                </div>

                                                                <div>
                                                                    <a href="{{ route('admin.plates.edit', $plate) }}"><button
                                                                            class="btn btn-warning gray-hover border-0 button-shadow">Modifica</button></a>
                                                                </div>
                                                                {{-- cancella --}}
                                                                <button type="button"
                                                                    class="btn btn-danger gray-hover border-0 button-shadow"
                                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                                    data-plate-id="{{ $plate->id }}">
                                                                    Elimina
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>

                                    @include('shared.modal')
                            @endforeach
                            @endif
                        </div>
                        <!-- Scroll fino al link top -->
                        <div class="d-flex justify-content-center my-4 ">
                            <a class="btn btn-primary gray-hover border-0 button-shadow" href="#top">Torna su</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection
