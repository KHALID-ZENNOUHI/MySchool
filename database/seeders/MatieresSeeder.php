<?php

namespace Database\Seeders;

use App\Models\Matiere;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatieresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maths  = Matiere::create(['nom' => 'Maths']);
        $physique  = Matiere::create(['nom' => 'Physique']);
        $chimie  = Matiere::create(['nom' => 'Chimie']);
        $informatique  = Matiere::create(['nom' => 'Informatique']);
        $anglais  = Matiere::create(['nom' => 'Anglais']);
        $francais  = Matiere::create(['nom' => 'Francais']);
        $histoire  = Matiere::create(['nom' => 'Histoire']);
        $geographie  = Matiere::create(['nom' => 'Geographie']);
        $philosophie  = Matiere::create(['nom' => 'Philosophie']);
        $education_civique  = Matiere::create(['nom' => 'Education Civique']);
        $sport  = Matiere::create(['nom' => 'Sport']);
        $musique  = Matiere::create(['nom' => 'Musique']);
        $art_plastique  = Matiere::create(['nom' => 'Art Plastique']);
    }
}
