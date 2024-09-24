<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|max:100',
            'delivery_address' => 'required|max:255',
            'phone_number' => 'required|max:25',
            'price' => 'required'
        ]);
    }
}
