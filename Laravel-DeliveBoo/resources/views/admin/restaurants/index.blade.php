@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{-- message creazione nuovo ristorante --}}
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @if (!$restaurant || !$restaurant->restaurant_name)
                <div class="d-flex card-shadow align-items-center justify-content-around orange-border rounded my-5">
                    <div class="p-5">
                        <h1 class="text-dark">Oooops {{ Auth::user()->name }} sembra che non ci siano
                            ristoranti...
                            Perchè
                            non ne
                            aggiungi
                            uno? </h1>
                    </div>

                    <div class="p-5">
                        <a href="{{ route('admin.restaurants.create') }}"><button
                                class="btn btn-success button-shadow">Aggiungi
                                Ristorante</button>
                    </div></a>
                </div>
            @else
                {{-- colonna foto --}}
                <div class="row orange-border card-shadow rounded my-5 p-3 relative">
                    @if ($restaurant->img)
                        <div class="col-lg-6 col-md-6 col-sm-12 d-flex">
                            <img class="rounded img_ristorante" src="{{ asset('storage/' . $restaurant->img) }}"
                                alt="">
                        </div>
                    @endif

                    {{-- colonna info --}}
                    <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-column justify-content-between">
                        <div class=" mb-4">
                            <h1>{{ $restaurant->restaurant_name }}</h1>
                            <p class="ms-1 text-secondary">Creato il: {{ $restaurant->created_at }}</p>
                        </div>

                        {{-- piatti --}}

                        <div class="piatti">
                            @if ($restaurant->plates->isEmpty())
                                <div class="d-flex justify-content-between">
                                    <h4>Non ci sono piatti disponibili</h4>
                                    <button class="btn btn-primary button-shadow gray-hover border-0"><a
                                            href="{{ route('admin.plates.index', $restaurant) }}">Aggiungi
                                            Piatto</a></button>
                                </div>
                            @else
                                <div
                                    class="d-flex
                                         justify-content-between align-items-center">
                                    <h2>Piatti:</h2>

                                    <button class="btn btn-primary button-shadow gray-hover border-0 all-plt-btn-abs"><a
                                            href="{{ route('admin.plates.index', $restaurant) }}">Visualizza tutti i
                                            Piatti</a></button>
                                </div>
                                <hr class="orange-border my-2">
                                <div>
                                    @foreach ($restaurant->plates as $plate)
                                        @if ($plate->available)
                                            <div class="d-flex align-items-center justify-content-between lista-piatti ">
                                                <div class="d-flex align-items-center">
                                                    @if ($plate->img)
                                                        <img width="50px" height="50px" class="me-2"
                                                            src="{{ asset('storage/' . $plate->img) }}"
                                                            alt="{{ $plate->name }}">
                                                    @endif
                                                    <h3>{{ $plate->name }}</h3>
                                                </div>
                                                <div>
                                                    <h3>Prezzo: {{ $plate->price }}€</h3>
                                                </div>
                                            </div>
                                            <hr class="orange-border my-2">
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="categoria">
                            <div class="d-flex justify-content-between">
                                <h3>Categorie:</h3>
                                <h3>{{ implode(', ', $restaurant->categories->pluck('name')->toArray()) }}</h3>
                            </div>
                        </div>
                        <div class="d-flex gap-3 justify-content-center mt-3">
                            <div>
                                {{-- visualizza dettagli --}}
                                <button class="btn deliveboo-orange-background gray-hover button-shadow"><a
                                        href="{{ route('admin.restaurants.show', $restaurant) }}">Dettagli</a></button>
                            </div>
                            {{-- modifica --}}
                            <div>
                                <button class="btn btn-warning button-shadow border-0 gray-hover"><a
                                        href="{{ route('admin.restaurants.edit', $restaurant) }}">Modifica</a></button>
                            </div>

                            <div>
                                <button type="button" class="btn btn-danger border-0 button-shadow gray-hover"
                                    data-bs-toggle="modal" data-bs-target="#deleteRestaurant"
                                    data-restaurant-id="{{ $restaurant->id }}">
                                    Elimina
                                </button>
                                {{-- cancella --}}
                            </div>
                        </div>
                    </div>
                </div>
                @include('shared.restaurantModal')
            @endif
            @foreach ($restaurant->orders as $order)
                <h2>{{ $order->customer_name }}</h2>
                <h3>Prezzo: {{ $order->price }}€</h3>
            @endforeach
        </div>
    </div>
@endsection
