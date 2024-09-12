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
                {{-- colonna foto --}}
                <div class="d-flex justify-content-around border border-secondary rounded my-5">
                    {{-- colonna info --}}
                    <div class="d-flex flex-column justify-content-between col">
                        <div class="piatti p-5">
                            <div class="d-flex justify-content-between mb-5">
                                <h1>Piatti Disponibili</h1>
                                <button class="btn btn-primary"><a href="{{ route('admin.plates.index') }}">
                                        Aggiungi
                                        Piatto</a></button>
                            </div>
                            <div>
                                @foreach ($plates as $plate)
                                    <div class="border border-secondary my-5">
                                        <div class="p-4">
                                            <h2 class="text-center mb-4">{{ $plate->name }}</h2>
                                            <div class="img_piatto m-auto mb-4">
                                                <img class="rounded" src="{{ $plate->img }}" alt="">
                                            </div>
                                            <div>
                                                <p>{{ $plate->description }}</p>
                                                <p>{{ $plate->price }}€</p>
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
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
