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
        $categoryNames = $request->query('categories');
        $user = auth()->user();
        $restaurants = Restaurant::with(['plates', 'categories', 'orders'])->when($categoryNames, function ($query, $categoryNames) {
            $categoryArray = explode(',', $categoryNames); // Split the string into an array of categories
            return $query->whereHas('categories', function ($q) use ($categoryArray) {
                $q->whereIn('name', $categoryArray); // Assuming 'name' is the column in the categories table
            }, '=', count($categoryArray)); // Ensures the restaurant has all the categories
        })->paginate(4);

        return response()->json([
            'status' => 'success',
            'results' => $restaurants,
            'user' => $user,
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
    //  funzione per visualizzare i piatti di un ristorante
    public function getPlates($id)
    {
        // Trova il ristorante per ID
        $restaurant = Restaurant::find($id);

        // Verifica se il ristorante esiste
        if (!$restaurant) {
            return response()->json([
                'status' => 'error',
                'message' => 'Restaurant not found',
            ], 404);
        }

        // Ottieni i piatti associati al ristorante
        $plates = $restaurant->plates;

        return response()->json([
            'status' => 'success',
            'result' => $plates,
        ], 200); // Usa 200 per successo
    }
}
