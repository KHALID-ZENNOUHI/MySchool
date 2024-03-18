<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nom' => 'admin',
            'prenom' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role_id' => 1,
            'date_naissance' => '1999-01-01',
            'lieu_naissance' => 'Rabat',
            'adresse' => 'Rabat',
            'sexe' => 'homme',
            'photo' => 'admin.jpg',
        ]);
    }
}
