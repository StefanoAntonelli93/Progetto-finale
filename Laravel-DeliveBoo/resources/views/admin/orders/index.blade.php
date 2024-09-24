@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($orders as $order)
            {{ $order->id }}
            {{ $order->customer_name }}
            {{ $order->delivery_address }}
            {{ $order->price }}
        @endforeach
    </div>
@endsection
