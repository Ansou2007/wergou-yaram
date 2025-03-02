<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pharmacies;
use App\Models\Villes;
use Illuminate\Http\Request;

class PharmacieController extends Controller
{
    

    
    public function store(Request $request)
    {
        try {
            //code...
        } catch (\Throwable $th) {

            return response()->json([
                'message' => 'Une erreur est survenue lors de la connexion',
                'error' => $th->getMessage(),
            ], 500);
        }
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


    public function pharmacies()
    {
        $pharmacies = Pharmacies::all();
        return response()->json($pharmacies);
    }
}
