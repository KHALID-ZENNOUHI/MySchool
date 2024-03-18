<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emploi extends Model
{
    use HasFactory;

    protected $fillable = ['heure_debut', 'heure_fin'];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
