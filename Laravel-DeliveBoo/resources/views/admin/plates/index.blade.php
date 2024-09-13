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
                    <a href="{{ route('admin.restaurants.index') }}"> <button class="btn btn-primary">Torna
                            Indietro</button></a>
                </div>
                <div class="d-flex justify-content-around border border-secondary rounded my-5">
                    {{-- colonna info --}}
                    <div class="d-flex flex-column justify-content-between col">
                        <div class="piatti p-5">
                            @if ($plates->isEmpty())
                                <div
                                    class="d-flex align-items-center justify-content-around border border-secondary rounded my-5">
                                    <div class="p-5">
                                        <h1 class="text-dark">Sembra che non ci siano piatti, perchè non ne
                                            agigungi
                                            uno?</h1>
                                        <div class="text-center mt-5">
                                            <a href="{{ route('admin.plates.create') }}"><button class="btn btn-primary">
                                                    Aggiungi
                                                    Piatto</button></a>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-between mb-5">
                                        <h1>Piatti Disponibili</h1>
                                        <button class="btn btn-primary"><a href="{{ route('admin.plates.create') }}">
                                                Aggiungi
                                                Piatto</a></button>
                                    </div>
                                    <div>
                                        @foreach ($plates as $plate)
                                            <div
                                                class="border border-secondary rounded my-5 {{ $plate->available ? '' : 'opacity-50' }} ">

                                                <div class="p-4">
                                                    <h2 class="text-center mb-4">{{ $plate->name }}</h2>
                                                    @if (!$plate->available)
                                                        <h2 class="text-danger text-center ">Non
                                                            Disponibile</h2>
                                                    @endif
                                                    <div class="img_piatto m-auto">
                                                        @if ($plate->img)
                                                            <div class="img_ristorante col p-2 ">
                                                                <img class="rounded"
                                                                    src="{{ asset('storage/' . $plate->img) }}"
                                                                    alt="{{ $plate->name }}">
                                                            </div>
                                                        @endif

                                                    </div>
                                                    <div class="text-center">
                                                        <h3>{{ $plate->description }}</h3>
                                                        <h3>{{ $plate->price }}€</h3>
                                                    </div>
                                                    <div class="d-flex gap-3 justify-content-center">
                                                        <div>
                                                            {{-- visualizza dettagli --}}
                                                            <a href="{{ route('admin.plates.show', $plate) }}"><button
                                                                    class="btn btn-info">Dettagli</button></a>
                                                        </div>

                                                        <div>
                                                            <a href="{{ route('admin.plates.edit', $plate) }}"><button
                                                                    class="btn btn-warning">Modifica</button></a>
                                                        </div>
                                                        {{-- cancella --}}
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal"
                                                            data-plate-id="{{ $plate }}">
                                                            Elimina
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            @include('shared.modal')
                                        @endforeach
                            @endif
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
    </div>

@endsection
