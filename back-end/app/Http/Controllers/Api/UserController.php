<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return response()->json($data);
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
        //
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

    // Inscription
    public function register(Request $request)
    {
        try {
            // Validation des données d'entrée
            $validation = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users,email',
                'telephone' => 'required|string|unique:users,telephone',
                'password' => 'required|string|min:6',
            ], [
                'name.required' => 'Le nom complet est obligatoire',
                'email.required' => "L'adresse mail est obligatoire",
                'email.unique' => "L'adresse mail existe déjà",
                'telephone.required' => "Le numéro de téléphone est obligatoire",
                'telephone.unique' => "Le numéro de téléphone existe déjà",
                'password.required' => "Le mot de passe est obligatoire",
                'password.min' => "Le mot de passe doit contenir au moins 6 caractères",
            ]);

            // Création de l'utilisateur
            $user = User::create([
                'name' => $validation['name'],
                'email' => $validation['email'],
                'telephone' => $validation['telephone'],
                'password' => Hash::make($validation['password']),
            ]);

            // Génération du token d'authentification
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message' => 'Inscription réussie',
                'access_token' => $token,
                'user' => $user,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Une erreur est survenue lors de l\'inscription',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    // Connexion
    public function login(Request $request)
    {
        try {
            $validation = $request->validate(
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ],
                [
                    'email.required' => "L'adresse e-mail est obligatoire",
                    'email.email' => "Veuillez entrer une adresse e-mail valide",
                    'password.required' => "Le mot de passe obligatoire",
                ]
            );

            $user = User::where('email', $validation['email'])->first();

            if (!$user || !Hash::check($validation['password'], $user->password)) {
                return response()->json([
                    'message' => 'Identifiants incorrects',
                ], 401);
            }

            // Génération du token
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Connexion réussie',
                'access_token' => $token,
                'user' => $user,
            ], 200);
        } catch (\Throwable $th) {

            return response()->json([
                'message' => 'Une erreur est survenue lors de la connexion',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request)
    {
         try {
            // Supprimer uniquement le token en cours
           // $request->user()->currentAccessToken()->delete();

            $request->user()->tokens()->delete();


            return response()->json([
                'message' => 'Déconnexion réussie',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Une erreur est survenue lors de la déconnexion',
                'error' => $e->getMessage(),
            ], 500);
        } 
       
    }
}
