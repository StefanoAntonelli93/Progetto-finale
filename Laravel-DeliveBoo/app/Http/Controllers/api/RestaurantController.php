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
        $restaurants = Restaurant::with(['plates', 'categories', 'orders'])->when($categoryNames, function ($query, $categoryNames) {
            $categoryArray = explode(',', $categoryNames); // Split the string into an array of categories
            return $query->whereHas('categories', function ($q) use ($categoryArray) {
                $q->whereIn('name', $categoryArray); // Assuming 'name' is the column in the categories table
            }, '=', count($categoryArray)); // Ensures the restaurant has all the categories
        })->paginate(4);

        return response()->json([
            'status' => 'success',
            'results' => $restaurants,
        ]);
    }
}
