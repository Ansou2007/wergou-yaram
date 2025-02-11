<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Villes;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    

    public function villes()
    {
        $data = Villes::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
       /*  $request->validate(
            [
                'nom'=>'require|unique:villes,nom',
            ]
            );
 */

        $ville = new Villes();
        $ville->nom = $request->nom;
        $ville->save();
        return response()->json(
            [
                'message' =>"Ville ajoutée",
                'data'=>$ville
                ]
            );
    }

}
