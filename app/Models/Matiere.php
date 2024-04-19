<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function controles()
    {
        return $this->hasMany(Controle::class);
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
