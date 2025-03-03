<?php

namespace App\Http\Controllers;

use App\Models\Pharmacies;
use App\Models\Villes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $villes = Villes::all();
        $data = Pharmacies::all();
        return view('pharmacies.index',compact('villes','data'));

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
                'nom'=>'required',
                'telephone'=>'required|unique:pharmacies,telephone',
                'longitude'=>'required|unique:pharmacies,longitude',
                'latitude'=>'required|unique:pharmacies,latitude',
                'ville'=>'required',
                
            ],
            [
                'nom.required'=>'Le nom de la pharmacie est Obligatoire',
                'telephone.required'=>'Le numero de telephone est Obligatoire',
                'telephone.unique'=>'Le numero de telephone existe déja',
                'ville.required'=>'La ville est Obligatoire',
                'longitude.required'=>'La geolocalisation est Obligatoire',
                'latitude.required'=>'La geolocalisation est Obligatoire',
                'latitude.unique'=>'Les Coordonnée existe déja',
                'longitude.unique'=>'Les Coordonnée existe déja',
            ]
            );

            $data = new Pharmacies();
            $data->nom = $request->nom;
            $data->telephone = $request->telephone;
            $data->adresse = $request->adresse;
            $data->ville_id = $request->ville;
            $data->longitude = $request->longitude;
            $data->latitude = $request->latitude;
            $data->user_id = Auth::id();
            $data->save();
            return response()->json(['message'=>"Pharmacie ajoutée avec succees"]);
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
    public function destroy(string $id)
    {
        //
    }
}
