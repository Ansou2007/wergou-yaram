<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return view('utilisateurs.index',compact('data'));
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
                'email'=>'required|unique:users,email',
                'telephone'=>'required|unique:users,telephone',
                'role'=>'required',
                
            ],
            [
                'nom.required'=>'Le nom  est Obligatoire',
                'email.required'=>'Email Obligatoire',
                'email.unique'=>'Email existe déja',
                'telephone.required'=>'Le numero de telephone est Obligatoire',
                'telephone.unique'=>'Le numero de telephone existe déja',
                'role.required'=>'Le role est Obligatoire',
            ]
            );

            $data = new User();
            $data->name = $request->nom;
            $data->email = $request->email;
            $data->telephone = $request->telephone;
            $data->role = $request->role;
            $data->password = Hash::make('passer123');
            $data->save();
            return response()->json(['message'=>"Utilisateur ajoutée avec succees"]);
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
        $data = User::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    $request->validate(
        [
            'utilisateur_id' => 'required|exists:users,id',
            'nom' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->utilisateur_id,
            'telephone' => 'required|unique:users,telephone,' . $request->utilisateur_id,
            'role' => 'required',
        ],
        [
            'nom.required' => 'Le nom est obligatoire',
            'email.required' => 'Email obligatoire',
            'email.email' => 'Email invalide',
            'email.unique' => 'Email existe déjà',
            'telephone.required' => 'Le numéro de téléphone est obligatoire',
            'telephone.unique' => 'Le numéro de téléphone existe déjà',
            'role.required' => 'Le rôle est obligatoire',
        ]
    );

    $data = User::find($request->utilisateur_id);
    $data->name = $request->nom;
    $data->email = $request->email;
    $data->telephone = $request->telephone;
    $data->role = $request->role;
    $data->save();

    return response()->json(['message' => "Utilisateur modifié avec succès"]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
