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
                    <a class="text-primary" href="{{ route('admin.restaurants.index') }}"><- indietro</a>
                </div>
                {{-- colonna foto --}}
                <div class="d-flex justify-content-around border border-secondary rounded my-5">
                    {{-- colonna info --}}
                    <div class="d-flex flex-column justify-content-between col">
                        <div class="piatti p-5">
                            <div class="d-flex justify-content-between mb-5">
                                <h1>Piatti Disponibili</h1>
                                <button class="btn btn-primary"><a href="{{ route('admin.plates.create') }}">
                                        Aggiungi
                                        Piatto</a></button>
                            </div>
                            <div>
                                @foreach ($plates as $plate)
                                    <div class="border border-secondary my-5">
                                        <div class="p-4">
                                            <h2 class="text-center mb-4">{{ $plate->name }}</h2>
                                            <div class="img_piatto m-auto mb-4">
                                                @if ($plate->img)
                                                    <div class="img_ristorante col p-5 ">
                                                        <img class="rounded" src="{{ asset('storage/' . $plate->img) }}"
                                                            alt="">
                                                    </div>
                                                @endif
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
                                                            href="{{ route('admin.plates.show', $plate) }}">Dettagli</a></button>
                                                </div>

                                                <div>
                                                    <button class="btn btn-warning"><a
                                                            href="{{ route('admin.plates.edit', $plate) }}">Modifica</a></button>
                                                </div>
                                                {{-- cancella --}}
                                                <form action="{{ route('admin.plates.destroy', $plate) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">Elimina</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Scroll fino al link top -->
                            <div class="d-flex justify-content-center my-4">
                                <a class="btn btn-primary" href="#top">Torna su</a>
                            </div>

                        </div>

                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection
