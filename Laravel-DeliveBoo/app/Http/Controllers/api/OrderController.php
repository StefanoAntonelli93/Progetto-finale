<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Crea un nuovo ordine
    public function index()
    {
        // Validazione dei dati

        $orders = Order::with('restaurant', 'plates')->paginate(10);
        return response()->json([
            'status' => 'success',
            'results' => $orders,
        ], 201);
    }
    public function store(Request $request)
    {
        // Convalida i dati in arrivo
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'delivery_address' => 'required|string|max:255',
            'restaurant_id' => 'required|integer',
            'price' => 'required|integer',
            'plate_id' => 'required|array',
            'plate_id.*' => 'integer|exists:plates,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1'
        ]);

        // Salva l'ordine nel database
        $order = Order::create([
            'customer_name' => $validatedData['customer_name'],
            'delivery_address' => $validatedData['delivery_address'],
            'restaurant_id' => $validatedData['restaurant_id'],
            'price' => $validatedData['price'],
            'order_date' => now(), // Imposta la data dell'ordine
        ]);

        $plateIds = $validatedData['plate_id'];
        $quantities = $validatedData['quantity'];
        foreach ($plateIds as $index => $plateId) {
            $order->plates()->attach($plateId, ['quantity' => $quantities[$index]]);
        }

        return response()->json([
            'status' => 'success',
            'order' => $order->load('plates') // Carica i piatti associati
        ], 201);
    }
}
