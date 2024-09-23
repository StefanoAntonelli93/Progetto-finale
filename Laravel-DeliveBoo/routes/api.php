<?php

use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\RestaurantController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// apiresource crea una resource senza i metodi edit e create
Route::apiResource('restaurants', RestaurantController::class);
// per visualizzare api su url -> http://127.0.0.1:8000/api/restaurants
Route::apiResource('order', OrderController::class);

// rotta per visualizzare ristorante
Route::get('restaurants/{id}', [RestaurantController::class, 'show']);

// rotta per visualizzare menu ristorante
Route::get('restaurants/{id}/plates', [RestaurantController::class, 'getPlates']);
