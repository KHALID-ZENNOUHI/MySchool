<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'photo',
        'classe_id',
        'responsable_id',
    ];

    public function responsable()
    {
        return $this->belongsTo(Responsable::class);
    }

    public function absence()
    {
        return $this->hasMany(Absence::class);
    }
}
