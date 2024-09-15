<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index()
    {
        // aggiungo 4 ristoranti per pagina e le tabelle relazionate a tabella restaurants con l'eager loading
        $restaurants = Restaurant::with('plates', 'categories', 'orders')->paginate(4);

        return response()->json([
            'status' => 'success',
            'results' => $restaurants,
        ]);
    }
}
