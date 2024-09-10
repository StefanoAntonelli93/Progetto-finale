@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col mt-4">
                {{-- se non esiste un collegamento tra admin e hotel allora sprono a crearne uno --}}
                @if (!$restaurant || !$restaurant->restaurant_name)
                    <h1 class="text-dark mt-3">Oooops {{ Auth::user()->name }} sembra che non ci siano post... Perchè non ne
                        crei
                        uno? </h1>
                    <button class="btn btn-success""><a href="{{ route('admin.restaurants.create') }}">Crea
                            Ristorante</a></button>
                @else
                    {{-- message creazione nuovo ristorante --}}
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif


                    <h1>Ecco il tuo ristorante : {{ $restaurant->restaurant_name }}</h1>
                @endif
            </div>
        </div>
    </div>
@endsection
