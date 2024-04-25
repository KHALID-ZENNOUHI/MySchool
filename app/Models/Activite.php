<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'date', 'ressources','title', 'description', 'classe_id', 'formateur_id'];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
