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
                    <h1 class="text-dark mt-3">Oooops {{ Auth::user()->name }} sembra che non ci siano ristoranti... Perchè
                        non ne
                        aggiungi
                        uno? </h1>
                    <button class="btn btn-success""><a href="{{ route('admin.restaurants.create') }}">Aggiungi
                            Ristorante</a></button>
                @else
                    <h1>Ecco il tuo ristorante : {{ $restaurant->restaurant_name }}</h1>
                    @if ($restaurant->img)
                        <div>
                            <img src="{{ asset('storage/' . $restaurant->img) }}" alt="">
                        </div>
                    @endif
                    <div class="d-flex gap-3">
                        {{-- visualizza dettagli --}}
                        <button class="btn btn-info"><a
                                href="{{ route('admin.restaurants.show', $restaurant) }}">Dettagli</a></button>
                        {{-- modifica --}}
                        <button class="btn btn-warning"><a
                                href="{{ route('admin.restaurants.edit', $restaurant) }}">Modifica</a></button>
                        {{-- cancella --}}
                        <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Elimina</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
