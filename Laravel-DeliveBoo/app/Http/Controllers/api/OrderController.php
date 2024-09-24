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
            'price' => 'required|integer'

        ]);

        // Salva l'ordine nel database
        $order = Order::create([
            'customer_name' => $validatedData['customer_name'],
            'delivery_address' => $validatedData['delivery_address'],
            'restaurant_id' => $validatedData['restaurant_id'],
            'price' => $validatedData['price'],
            'order_date' => now(), // Imposta la data dell'ordine
        ]);

        return response()->json($order, 201); // Restituisce una risposta JSON con l'ordine creato
    }
}
