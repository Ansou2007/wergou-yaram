<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ApiResource()]
class Pharmacies extends Model
{
    /** @use HasFactory<\Database\Factories\PharmaciesFactory> */
    use HasFactory;

    public function villes()
    {
        return $this->belongsTo(Villes::class,'ville_id');
    }
}
