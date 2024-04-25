<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnneScolaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anneeScolaire = [
            ['nom' => 2024],
            ['nom' => 2025],
            ['nom' => 2026],
            ['nom' => 2027],
            ['nom' => 2028],
            ['nom' => 2029],
            ['nom' => 2030],
        ];

        foreach ($anneeScolaire as $annee) {
            \App\Models\AnneeScolaire::create($annee);
        }
    }
}
