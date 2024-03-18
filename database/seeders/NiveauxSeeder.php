<?php

namespace Database\Seeders;

use App\Models\Niveau;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NiveauxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $primaires  = Niveau::create(['nom' => 'Primaire']);
        $college    = Niveau::create(['nom' => 'College']);
        $lycee      = Niveau::create(['nom' => 'Lycee']);
    }
}
