<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;
    protected $fillable = ['jours', 'start_datetime', 'end_datetime', 'matiere_id', 'formateur_id', 'classe_id', 'color'];


    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function formateur()
    {
        return $this->belongsTo(Formateur::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}

