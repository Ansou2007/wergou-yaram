<?php

namespace Database\Seeders;

use App\Models\Villes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Villes::insert(
            [
                [
                    'nom'=>'Dakar'
                ],
                [
                    'nom'=>'Thies'
                ],
                [
                    'nom'=>'Bignona'
                ],
                [
                    'nom'=>'Sebikotane'
                ]
            ]
                );
    }
}
