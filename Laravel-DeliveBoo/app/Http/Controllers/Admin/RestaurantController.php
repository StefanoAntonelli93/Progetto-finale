<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $admin = auth()->user();
        $restaurant = $admin->restaurant;
        return view('admin.restaurants.index', compact('restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {
        $data = $request->validated();
        $data = $request->all();

        // visualizzo utente corrente
        $current_user = Auth::user()->id;
        // file storage
        $img_path = Storage::put('uploads', $data['img']);

        $restaurant = new Restaurant();
        $restaurant->restaurant_name = $data['restaurant_name'];
        $restaurant->description = $data['description'];
        $restaurant->phone_number = $data['phone_number'];
        $restaurant->p_iva = $data['p_iva'];
        $restaurant->address = $data['address'];
        $restaurant->img = $img_path;

        // visualizzo utente corrente
        $restaurant->user_id = $current_user;
        $restaurant->save();

        return redirect()->route('admin.restaurants.index', $restaurant)->with('message', 'Ristorante aggiunto con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        if ($restaurant->img) {
            Storage::delete($restaurant->img);
        }
        $restaurant->delete();
        return redirect()->route('admin.restaurants.index')->with('message', 'Ristorante eliminato correttamente');
    }
}
