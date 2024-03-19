<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Controle extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'date', 'matiere_id', 'classe_id'];

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function formateur()
    {
        return $this->belongsTo(Formateur::class);
    }
}
