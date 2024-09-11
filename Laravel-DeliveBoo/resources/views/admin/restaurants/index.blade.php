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
                    <h1 class="text-dark mt-3">Oooops {{ Auth::user()->name }} sembra che non ci siano post... Perchè non ne
                        crei
                        uno? </h1>
                    <button class="btn btn-success""><a href="{{ route('admin.restaurants.create') }}">Crea
                            Ristorante</a></button>
                @else
                    <h1>Ecco il tuo ristorante : {{ $restaurant->restaurant_name }}</h1>
                    @if ($restaurant->img)
                        <div>
                            <img src="{{ asset('storage/' . $restaurant->img) }}" alt="">
                        </div>
                    @endif
                    <p>modifica

                    <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">elimina</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
