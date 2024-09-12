<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditRestaurantRequest;
use App\Http\Requests\StoreRestaurantRequest;
use App\Models\Category;
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
        $categories = Category::all();
        return view('admin.restaurants.index', compact('restaurant', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('admin.restaurants.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {
        $data = $request->validated();
        // visualizzo utente corrente
        $current_user = Auth::user()->id;
        $restaurant = new Restaurant();
        $restaurant->restaurant_name = $data['restaurant_name'];
        $restaurant->description = $data['description'];
        $restaurant->phone_number = $data['phone_number'];
        $restaurant->p_iva = $data['p_iva'];
        $restaurant->address = $data['address'];
        if (isset($data['img'])) {
            // Il campo img è presente e puoi processarlo.
            $img_path = Storage::put('uploads', $data['img']);
            $restaurant->img = $img_path;
        }
        // visualizzo utente corrente
        $restaurant->user_id = $current_user;
        $restaurant->save();
        //collego le categorie al ristorante
        if ($request->has('categories')) {
            $restaurant->categories()->attach($request->categories);
        };


        return redirect()->route('admin.restaurants.index', $restaurant)->with('message', 'Ristorante aggiunto con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        $categories = Category::all();
        return view('admin.restaurants.show', compact('restaurant', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        $categories = Category::all();
        return view('admin.restaurants.edit', compact('restaurant', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditRestaurantRequest $request, Restaurant $restaurant)
    {

        $data = $request->validated();

        // Controlla se è stata caricata una nuova immagine
        if ($request->hasFile('img')) {
            // Elimina l'immagine precedente se esiste
            if ($restaurant->img) {
                Storage::delete($restaurant->img);
            }
            // Carica la nuova immagine
            $data['img'] = $request->file('img')->store('images', 'public');
        }

        // Aggiorna il ristorante con i dati, inclusa la nuova immagine (se caricata)
        $restaurant->update($data);
        // aggiorno le categorie che ho modificato
        if ($request->has('categories')) {
            $restaurant->categories()->sync($request->categories);
        }

        return redirect()->route('admin.restaurants.index', $restaurant)->with('message', 'Ristorante modificato con successo');
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
