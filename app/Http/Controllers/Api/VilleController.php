<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Villes;
use Illuminate\Http\Request;

class VilleController extends Controller
{


    
    // Liste Ville
    public function villes()
    {
        $data = Villes::all();
        return response()->json($data);
    }
    // Recuperer une Ville
    public function ville($id)
    {
        try {
            $data = Villes::findOrFail($id);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ville non trouvée'], 404);
        }
    }
    

    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'nom' => 'required|unique:villes,nom',
                ],
                [
                    'nom.required' => "Le nom de la ville est requis.",
                    'nom.unique' => "Le nom de la ville existe déjà."
                ]
            );

            $ville = new Villes();
            $ville->nom = $request->nom;
            $ville->save();

            return response()->json(
                [
                    'message' => "Ville ajoutée",
                    'data' => $ville
                ]
            );
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Une erreur est survenue lors de la connexion',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
