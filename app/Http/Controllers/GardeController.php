<?php

namespace App\Http\Controllers;

use App\Models\Gardes;
use App\Models\Pharmacies;
use Illuminate\Http\Request;

class GardeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Gardes::all();
        $pharmacies = Pharmacies::all();
        return view('gardes.index', compact('data', 'pharmacies'));
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
                'pharmacie' => 'required|exists:pharmacies,id',
                'date_debut' => 'required|date',
                'date_fin' => 'required|date|after:date_debut',
                'type' => 'nullable|string',
            ],
            [
                'pharmacie.required' => 'La pharmacie est obligatoire.',
                'pharmacie.exists' => 'Pharmacie invalide.',
                'date_debut.required' => 'La date de début est obligatoire.',
                'date_fin.required' => 'La date de fin est obligatoire.',
                'date_fin.after' => 'La date de fin doit être postérieure à la date de début.',
            ]
        );
    
        // Vérification du chevauchement avec d'autres gardes
        $chevauchement = Gardes::where('pharmacie_id', $request->pharmacie)
            ->where(function ($query) use ($request) {
                $query->whereBetween('date_debut', [$request->date_debut, $request->date_fin])
                      ->orWhereBetween('date_fin', [$request->date_debut, $request->date_fin])
                      ->orWhere(function ($query) use ($request) {
                          $query->where('date_debut', '<=', $request->date_debut)
                                ->where('date_fin', '>=', $request->date_fin);
                      });
            })->exists();
    
        if ($chevauchement) {
            return response()->json(['message' => 'Une autre garde existe déjà sur cette période.'], 422);
        }
    
        // Création de la garde
        $data = new Gardes();
        $data->pharmacie_id = $request->pharmacie;
        $data->date_debut = $request->date_debut;
        $data->date_fin = $request->date_fin;
        $data->type = $request->type;
        $data->save();
    
        return response()->json(['message' => 'Ajout avec succès']);
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
        $data = Gardes::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate(
            [
                'garde_id' => 'required|exists:gardes,id',
                'pharmacie' => 'required|exists:pharmacies,id',
                'date_debut' => 'required|date',
                'date_fin' => 'required|date|after:date_debut',
                'type' => 'nullable|string',
            ],
            [
                'garde_id.required' => 'Garde invalide.',
                'garde_id.exists' => 'Cette garde n\'existe pas.',
                'pharmacie.required' => 'La pharmacie est obligatoire.',
                'pharmacie.exists' => 'Pharmacie invalide.',
                'date_debut.required' => 'La date de début est obligatoire.',
                'date_fin.required' => 'La date de fin est obligatoire.',
                'date_fin.after' => 'La date de fin doit être postérieure à la date de début.',
            ]
        );
        $data = Gardes::find($request->garde_id);

        // Vérification du chevauchement avec d'autres gardes
        $chevauchement = Gardes::where('pharmacie_id', $request->pharmacie)
            ->where('id', '!=', $data->id) // Exclure la garde actuelle
            ->where(function ($query) use ($request) {
                $query->whereBetween('date_debut', [$request->date_debut, $request->date_fin])
                    ->orWhereBetween('date_fin', [$request->date_debut, $request->date_fin])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('date_debut', '<=', $request->date_debut)
                            ->where('date_fin', '>=', $request->date_fin);
                    });
            })->exists();

        if ($chevauchement) {
            return response()->json(['message' => 'Une autre garde existe déjà sur cette période.'], 422);
        }
        $data->pharmacie_id = $request->pharmacie;
        $data->date_debut = $request->date_debut;
        $data->date_fin = $request->date_fin;
        $data->type = $request->type;
        $data->update();
        return response()->json(['message' => 'Modification avec success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Gardes::findOrfail($id);
        $data->delete();
        return back();
    }
}
