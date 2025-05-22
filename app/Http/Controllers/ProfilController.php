<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    // Profil
    public function edit()
    {
        $profil = User::find(Auth::id());
        return view('profil.edit', compact('profil'));
    }
    // Mot de Passe
    public function change_password()
    {
        $profil = User::find(Auth::id());
        return view('profil.password_edit', compact('profil'));
    }

    // Modification Profil
    public function update(Request $request)
    {
        $request->validate(
            [
                "prenom" => 'required',
                "nom" => 'required',
                "telephone" => 'required|unique:users,telephone,' . Auth::id(),
                "email" => 'required|unique:users,email,' . Auth::id(),
                "photo" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048" // Validation de l'image
            ],
            [
                'prenom.required' => 'Le prénom est obligatoire',
                'nom.required' => 'Le nom est obligatoire',
                'telephone.required' => 'Le téléphone est obligatoire',
                'telephone.unique' => 'Le téléphone existe déjà',
                'email.required' => 'L\'email est obligatoire',
                'email.unique' => 'L\'email existe déjà',
                'photo.image' => 'Le fichier doit être une image',
                'photo.mimes' => 'Formats autorisés : jpeg, png, jpg, gif',
                'photo.max' => 'L\'image ne doit pas dépasser 2 Mo'
            ]
        );

        $profil = User::find(Auth::id());

        try {
            DB::beginTransaction(); // Démarrer une transaction

            $profil->prenom = $request->prenom;
            $profil->nom = $request->nom;
            $profil->telephone = $request->telephone;
            $profil->email = $request->email; // Mise à jour de l'email

            // Traitement de l'image de profil
            if ($request->hasFile('photo')) {
                $fichier = $request->file('photo');
                $nomFichier = 'profil_' . $profil->id . '_' . time() . '.' . $fichier->getClientOriginalExtension();
                $cheminStockage = 'profil/' . $nomFichier;

                // Supprimer l'ancienne photo
                if ($profil->photo && Storage::disk('public')->exists($profil->photo)) {
                    Storage::disk('public')->delete($profil->photo);
                }

                // Stocker la nouvelle photo
                $fichier->storeAs('profil', $nomFichier, 'public');
                $profil->photo = $cheminStockage;
            }

            $profil->save();
            DB::commit();

            return response()->json(['message' => "Profil modifié avec succès"]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => "Erreur lors de la mise à jour"], 500);
        }
    }

    // Modification Mot de Pass
    public function update_password(Request $request)
    {
        $request->validate([
           // "password_1" => 'required|min:6|confirmed',
            "password_1" => 'required|min:6',
        ], [
            "password_1.required" => "Le mot de passe est obligatoire.",
            "password_1.min" => "Le mot de passe doit contenir au moins 6 caractères.",
           // "password_1.confirmed" => "Les mots de passe ne correspondent pas.",
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password_1);
        $user->save();

        return response()->json(['message' => "Mot de passe modifié avec succès"]);
    }
}