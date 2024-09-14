@extends('layouts.app')
@section('content')
    <div class="container-sm p-5">
        <div class="row py-3">
            <div class="col-6 text-center">
                <img class="rounded w-50" src="{{ asset('storage/images/chef.jpg') }}" alt="chef">
            </div>
            <div class="col-6 d-flex flex-column gap-5 ">
                <h1>Benvenuto in Deliveboo!</h1>
                <p class="lh-lg">Il nostro sito è la piattaforma ideale per far conoscere e vendere i tuoi piatti
                    a una
                    clientela più ampia. Registrando il tuo ristorante su Deliveboo, potrai facilmente gestire ordini online
                    e
                    raggiungere nuovi clienti che cercano cibo delizioso e conveniente. Il nostro sistema semplice e
                    intuitivo ti
                    permette di caricare il menu, aggiornare i piatti e monitorare le vendite, il tutto mentre noi ci
                    occupiamo
                    della promozione e della gestione delle consegne. Unisciti a Deliveboo e porta il tuo ristorante
                    direttamente
                    sulla tavola dei tuoi clienti!</p>
                <div>
                    <button class="btn-orange"><a href="{{ route('admin.restaurants.index') }}">Vai al tuo
                            ristorante</a></button>
                </div>

            </div>
        </div>

    </div>
@endsection
