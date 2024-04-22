<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'filiere_id', 'annee_scolaire_id'];

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function matieres()
    {
        return $this->hasMany(Matiere::class);
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function controles()
    {
        return $this->hasMany(Controle::class);
    }

    public function formateur()
    {
        return $this->hasMany(Formateur::class);
    }

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function activites()
    {
        return $this->hasMany(Activite::class);
    }

    public function cours()
    {
        return $this->hasMany(Cours::class);
    }
}
