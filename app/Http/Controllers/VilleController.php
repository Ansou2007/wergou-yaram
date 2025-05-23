<?php

namespace App\Http\Controllers;

use App\Models\Villes;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Villes::all();
        return view('villes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nom' => 'required',
            ],
            [
                'nom.required' => 'Le nom  est Obligatoire',
            ]
        );

        $data = new Villes();
        $data->nom = $request->nom;
        $data->save();
        return response()->json(['message' => "Ville ajoutée avec succees"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Villes::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate(
            [
                'ville_id' => 'required|exists:villes,id',
                'nom' => 'required',
            ],
            [
                'nom.required' => 'Le nom est obligatoire',
                
            ]
        );

        $data = Villes::find($request->ville_id);
        $data->nom = $request->nom;
        $data->save();

        return response()->json(['message' => "Ville modifiée avec succès"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
