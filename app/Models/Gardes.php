<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


#[ApiResource]
class Gardes extends Model
{
    /** @use HasFactory<\Database\Factories\GardesFactory> */
    use HasFactory;


    public function pharmacies()
    {
        return $this->belongsTo(Pharmacies::class,'pharmacie_id');

    }
    
}
