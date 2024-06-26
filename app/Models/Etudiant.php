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
        'user_id'
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
    
    public function responsable()
    {
        return $this->belongsTo(Responsable::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
