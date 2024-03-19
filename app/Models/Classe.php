<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'filiere_id'];

    public function etudiant()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function matiere()
    {
        return $this->hasMany(Matiere::class);
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function controle()
    {
        return $this->hasMany(Controle::class);
    }

    public function emploi()
    {
        return $this->belongsTo(Emploi::class);
    }
}
