<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['nom' => 'admin']);
        $administateur = Role::create(['nom' => 'administateur']);
        $formateur = Role::create(['nom' => 'formateur']);
        $etudiant = Role::create(['nom' => 'etudiant']);
    }
}
