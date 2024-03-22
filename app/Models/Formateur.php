<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'email', 'telephone', 'adresse', 'date_naissance', 'sexe', 'photo'];

    public function controles()
    {
        return $this->hasMany(Controle::class);
    }
}
