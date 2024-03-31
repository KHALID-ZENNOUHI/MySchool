<?php

namespace Database\Seeders;

use App\Models\Classe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classe1 = Classe::create([
            'nom' => '1ere A',
            'filiere_id' => 1,
            'annee_scolaire_id' => 3,
            'formateur_id' => 1,

        ]);
        $classe2 = Classe::create([
            'nom' => '1ere B',
            'filiere_id' => 1,
            'annee_scolaire_id' => 3,
            'formateur_id' => 1,
        ]);
        $classe3 = Classe::create([
            'nom' => '1ere C',
            'filiere_id' => 1,
            'annee_scolaire_id' => 3,
            'formateur_id' => 1,
        ]);
        $classe4 = Classe::create([
            'nom' => '2eme A',
            'filiere_id' => 2,
            'annee_scolaire_id' => 3,
            'formateur_id' => 1,
        ]);
        $classe5 = Classe::create([
            'nom' => '2eme B',
            'filiere_id' => 2,
            'annee_scolaire_id' => 3,
            'formateur_id' => 1,
        ]);
        $classe6 = Classe::create([
            'nom' => '2eme C',
            'filiere_id' => 2,
            'annee_scolaire_id' => 3,
            'formateur_id' => 1,
        ]);
        $classe7 = Classe::create([
            'nom' => '3eme A',
            'filiere_id' => 3,
            'annee_scolaire_id' => 3,
            'formateur_id' => 1,
        ]);
        $classe8 = Classe::create([
            'nom' => '3eme B',
            'filiere_id' => 3,
            'annee_scolaire_id' => 3,
            'formateur_id' => 1,
        ]);
        $classe9 = Classe::create([
            'nom' => '3eme C',
            'filiere_id' => 3,
            'annee_scolaire_id' => 3,
            'formateur_id' => 1,
        ]);
    }
}
