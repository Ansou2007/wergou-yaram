<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert(
            [
                [
                    'name'=>'Ansoumane Michel ',
                    'email'=>'ansou13@gmail.com',
                    'telephone'=>'774418426',
                    'role'=>'admin',
                    'password'=>Hash::make('passer123')
                ],
                [
                    'name'=>'Babacar Ndiaye ',
                    'email'=>'babacar@gmail.com',
                    'telephone'=>'774418426',
                    'role'=>'admin',
                    'password'=>Hash::make('passer123')

                ]
            ]
                );
    }
}
