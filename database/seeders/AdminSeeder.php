<?php

namespace Database\Seeders;

use App\Models\User;
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
        $admin1 = User::create([
            'username' => 'khalid',
            'email' => 'khalidzennouhi48@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => '1',
        ]);
    }
}
