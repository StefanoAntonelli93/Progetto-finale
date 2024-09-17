<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        // aggiungo 4 ristoranti per pagina e le tabelle relazionate a tabella restaurants con l'eager loading
        $categoryName = $request->query('categories');
        $restaurants = Restaurant::with(['plates', 'categories', 'orders'])->when($categoryName, function ($query, $categoryName) {
            return $query->whereHas('categories', function ($q) use ($categoryName) {
                $q->where('name', $categoryName); // Assuming 'name' is the column in the categories table
            });
        })->paginate(4);

        return response()->json([
            'status' => 'success',
            'results' => $restaurants,
        ]);
    }

    // funzione show per visualizzare dettagli ristorante in base a id
    public function show($id)
    {
        $restaurant = Restaurant::with(['plates', 'categories', 'orders'])->find($id);

        if (!$restaurant) {
            return response()->json([
                'status' => 'error',
                'message' => 'Restaurant not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'result' => $restaurant,
        ]);
    }
}
