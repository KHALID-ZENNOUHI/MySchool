<?php

namespace Database\Seeders;

use App\Models\Filiere;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiliereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $premiere_college = Filiere::create([
            'nom' => 'premiere_college',
            'niveau_id' => 2,
        ]);
        $deuxieme_college = Filiere::create([
            'nom' => 'deuxieme_college',
            'niveau_id' => 2,
        ]);
        $troisieme_college = Filiere::create([
            'nom' => 'troisieme_college',
            'niveau_id' => 2,
        ]);
        $scieces_Maths = Filiere::create([
            'nom' => 'scieces_Maths',
            'niveau_id' => 3,
        ]);
        $scieces_exp = Filiere::create([
            'nom' => 'scieces_exp',
            'niveau_id' => 3,
        ]);
        $lettres_anglais = Filiere::create([
            'nom' => 'lettres_anglais',
            'niveau_id' => 3,
        ]);
        $lettres_francais = Filiere::create([
            'nom' => 'lettres_francais',
            'niveau_id' => 3,
        ]);
        $siences_eco = Filiere::create([
            'nom' => 'siences_eco',
            'niveau_id' => 3,
        ]);
        $generale = Filiere::create([
            'nom' => 'generale',
            'niveau_id' => 1,
        ]);

    }
}
