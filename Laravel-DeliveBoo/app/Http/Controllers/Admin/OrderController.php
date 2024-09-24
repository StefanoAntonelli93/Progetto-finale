<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $admin = auth()->user();
        $orders = Order::with(['restaurant', 'plates'])->get(); // Carica gli ordini con le relazioni
        return view('admin.orders.index', compact('orders')); // Restituisci la vista e passa gli ordini
    }
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('orders'));
    }
}
