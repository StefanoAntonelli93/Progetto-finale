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
                <div class="d-flex align-items-center justify-content-around border border-secondary rounded my-5">
                    <div class="p-5">
                        <h1 class="text-dark mt-3 ">Oooops {{ Auth::user()->name }} sembra che non ci siano
                            ristoranti...
                            Perchè
                            non ne
                            aggiungi
                            uno? </h1>
                    </div>

                    <div class="p-5">
                        <a href="{{ route('admin.restaurants.create') }}"><button class="btn btn-success">Aggiungi
                                Ristorante</button>
                    </div></a>
                </div>
            @else
                {{-- colonna foto --}}
                <div class="row border border-secondary rounded my-5 p-3">
                    @if ($restaurant->img)
                        <div class="col-lg-6 col-md-6 col-sm-12 d-flex">
                            <img class="rounded img_ristorante" src="{{ asset('storage/' . $restaurant->img) }}"
                                alt="">
                        </div>
                    @endif

                    {{-- colonna info --}}
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="text-center">
                            <h1>{{ $restaurant->restaurant_name }}</h1>
                            <p class="ms-1">Creato il: {{ $restaurant->created_at }}</p>
                        </div>

                        {{-- piatti --}}

                        <div class="piatti">
                            @if ($restaurant->plates->isEmpty())
                                <div>
                                    <h2>Non ci sono piatti disponibili</h2>
                                    <button class="btn btn-primary"><a
                                            href="{{ route('admin.plates.index', $restaurant) }}">Aggiungi
                                            Piatto</a></button>
                                </div>
                            @else
                                <div
                                    class="d-flex
                                         justify-content-between align-items-center">
                                    <h2>Piatti:</h2>
                                    <button class="btn btn-primary"><a
                                            href="{{ route('admin.plates.index', $restaurant) }}">Visualizza tutti i
                                            Piatti</a></button>
                                </div>

                                <div>
                                    @foreach ($restaurant->plates as $plate)
                                        @if ($plate->available)
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <img width="50px" height="50px"
                                                        src="{{ asset('storage/' . $plate->img) }}"
                                                        alt="{{ $plate->name }}">
                                                    <p class="mx-2">{{ $plate->name }}</p>
                                                </div>
                                                <div>Prezzo: {{ $plate->price }}€</div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif



                        </div>
                        <div class="categoria">
                            <p>Categorie: {{ implode(', ', $restaurant->categories->pluck('name')->toArray()) }}</p>
                        </div>
                        <div class="d-flex gap-3 justify-content-center">
                            <div>
                                {{-- visualizza dettagli --}}
                                <button class="btn btn-info"><a
                                        href="{{ route('admin.restaurants.show', $restaurant) }}">Dettagli</a></button>
                            </div>
                            {{-- modifica --}}
                            <div>
                                <button class="btn btn-warning"><a
                                        href="{{ route('admin.restaurants.edit', $restaurant) }}">Modifica</a></button>
                            </div>

                            <div>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteRestaurant" data-restaurant-id="{{ $restaurant->id }}">
                                    Elimina
                                </button>
                                {{-- cancella --}}
                            </div>
                        </div>
                    </div>
                </div>
                @include('shared.restaurantModal')
            @endif

        </div>
    </div>
@endsection
