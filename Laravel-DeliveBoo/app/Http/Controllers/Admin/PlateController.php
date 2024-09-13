<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditPlateRequest;
use App\Http\Requests\StorePlateRequest;
use App\Models\Plate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        // visualizzo utente corrente

        $plate = new Plate();
        // aggiungo dati piatti
        $plate->name = $data['name'];
        $plate->description = $data['description'];
        $plate->ingredients = $data['ingredients'];
        $plate->price = $data['price'];
        $plate->allergenes = $data['allergenes'];

        if (isset($data['img'])) {
            // Il campo img è presente e puoi processarlo.
            $img_path = Storage::put('uploads', $data['img']);
            $plate->img = $img_path;
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
        // Controlla se è stata caricata una nuova immagine
        if ($request->hasFile('img')) {
            // Elimina l'immagine precedente se esiste
            if ($plate->img) {
                Storage::delete($plate->img);
            }
            // Carica la nuova immagine
            $data['img'] = $request->file('img')->store('images', 'public');
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
