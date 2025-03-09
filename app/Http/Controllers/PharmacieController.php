<?php

namespace App\Http\Controllers;

use App\Models\Pharmacies;
use App\Models\Villes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\json;

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
        $data = Pharmacies::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Vérifier si l'ID de la pharmacie est fourni et existe
        $data = Pharmacies::find($request->pharmacie_id);
        if (!$data) {
            return response()->json(['error' => "Pharmacie non trouvée"], 404);
        }
    
        // Validation des données
        $request->validate(
            [
                'nom' => 'required',
                'telephone' => 'required|unique:pharmacies,telephone,' . $request->pharmacie_id,
                'longitude' => 'required|unique:pharmacies,longitude,' . $request->pharmacie_id,
                'latitude' => 'required|unique:pharmacies,latitude,' . $request->pharmacie_id,
                'ville' => 'required',
            ],
            [
                'nom.required' => 'Le nom de la pharmacie est obligatoire',
                'telephone.required' => 'Le numéro de téléphone est obligatoire',
                'telephone.unique' => 'Le numéro de téléphone existe déjà',
                'ville.required' => 'La ville est obligatoire',
                'longitude.required' => 'La géolocalisation est obligatoire',
                'latitude.required' => 'La géolocalisation est obligatoire',
                'latitude.unique' => 'Les coordonnées existent déjà',
                'longitude.unique' => 'Les coordonnées existent déjà',
            ]
        );
    
        // Mise à jour des données
        $data->nom = $request->nom;
        $data->telephone = $request->telephone;
        $data->adresse = $request->adresse;
        $data->ville_id = $request->ville;
        $data->longitude = $request->longitude;
        $data->latitude = $request->latitude;
        $data->user_id = Auth::id();
        $data->save();
    
        return response()->json(['message' => "Pharmacie modifiée avec succès"]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Pharmacies::find($id);
        $data->delete();
        return back();

    }

    // Carte
    public function map()
    {

    }

    public function maps()
    {

    }
}
