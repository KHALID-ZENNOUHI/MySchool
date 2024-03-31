<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'cin', 'adresse', 'telephone', 'sexe', 'etudiant_id'];

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }
}
