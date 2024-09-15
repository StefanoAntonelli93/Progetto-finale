<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditPlateRequest;
use App\Http\Requests\StorePlateRequest;
use App\Models\Plate;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $admin = auth()->user();
        $plates = Plate::all();
        $restaurant = $admin->restaurant;
        // Ordina i piatti per data di creazione in ordine decrescente
        $plates = Plate::orderBy('created_at', 'desc')->get();
        return view('admin.plates.index', compact('restaurant', 'plates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlateRequest $request)
    {
        // passo i dati già validati nello store request
        $data = $request->validated();
        //creo lo slug
        $data['slug'] = Str::of($data['name'])->slug();

        $plate = new Plate();
        // aggiungo dati piatti
        $plate->restaurant_id = auth()->user()->restaurant->id;
        $plate->name = $data['name'];
        $plate->description = $data['description'];
        $plate->ingredients = $data['ingredients'];
        $plate->price = $data['price'];
        $plate->allergenes = $data['allergenes'];
        $plate->slug = $data['slug'];
        $plate->available = $data['available'];

        if (isset($data['img'])) {
            // Il campo img è presente e puoi processarlo.
            $img_path = Storage::put('uploads', $data['img']);
            $plate->img = $img_path;
            $plate->image_url = url('storage/' . $plate->img);
        }

        $plate->save();
        return redirect()->route('admin.plates.index', $plate)->with('message', 'Piatto aggiunto con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plate $plate)
    {
        return view('admin.plates.show', compact('plate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plate $plate)
    {
        return view('admin.plates.edit', compact('plate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditPlateRequest $request, Plate $plate)
    {
        $data = $request->validated();
        $data['slug'] = Str::of($data['name'])->slug();
        // Controlla se è stata caricata una nuova immagine
        if ($request->hasFile('img')) {
            // Elimina l'immagine precedente se esiste
            if ($plate->img) {
                Storage::delete($plate->img);
            }
            // Carica la nuova immagine
            $data['img'] = $request->file('img')->store('images', 'public');
            $data['image_url'] = url('storage/' . $data['img']);
        }

        $plate->update($data);

        return redirect()->route('admin.plates.index', $plate)->with('message', 'Piatto modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plate $plate)
    {
        //
        if ($plate->img) {
            Storage::delete($plate->img);
        }
        $plate->delete();
        return redirect()->route('admin.plates.index')->with('message', 'Piatto eliminato correttamente');
    }
}
