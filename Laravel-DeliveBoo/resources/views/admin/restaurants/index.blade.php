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

                            {{-- piatti --}}

                            <div class="piatti">
                                <div>
                                    @if (!$restaurant->plates)
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
