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
                'pharmacie' => 'required',
                'date_debut' => 'required|date',
                'date_fin' => 'required|date',
            ],
            [
                'pharmacie.required' => 'La pharmacie est Obligatoire',
                'date_debut.required' => 'Date debut Obligatoire',
                'date_fin.required' => 'Date Fin Obligatoire',
            ]
        );

        $data = new Gardes();
        $data->pharmacie_id = $request->pharmacie;
        $data->date_debut = $request->date_debut;
        $data->date_fin = $request->date_fin;
        $data->type = $request->type;
        $data->save();
        return response()->json(['message'=>'Ajout avec success']);
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
