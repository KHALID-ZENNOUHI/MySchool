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
            ['annee_scolaire_start' => '2021-09-01', 'annee_scolaire_end' => '2022-06-30'],
            ['annee_scolaire_start' => '2022-09-01', 'annee_scolaire_end' => '2023-06-30'],
            ['annee_scolaire_start' => '2023-09-01', 'annee_scolaire_end' => '2024-06-30'],
            ['annee_scolaire_start' => '2024-09-01', 'annee_scolaire_end' => '2025-06-30'],
            ['annee_scolaire_start' => '2025-09-01', 'annee_scolaire_end' => '2026-06-30'],
            ['annee_scolaire_start' => '2026-09-01', 'annee_scolaire_end' => '2027-06-30'],
            ['annee_scolaire_start' => '2027-09-01', 'annee_scolaire_end' => '2028-06-30'],
            ['annee_scolaire_start' => '2028-09-01', 'annee_scolaire_end' => '2029-06-30'],
            ['annee_scolaire_start' => '2029-09-01', 'annee_scolaire_end' => '2030-06-30'],
            ['annee_scolaire_start' => '2030-09-01', 'annee_scolaire_end' => '2031-06-30'],
        ];

        foreach ($anneeScolaire as $annee) {
            \App\Models\AnneeScolaire::create($annee);
        }
    }
}
