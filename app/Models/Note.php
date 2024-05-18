<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'matiere_id',
        'note',
        'classe_id',
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }

    // public function classe()
    // {
    //     return $this->belongsTo(Classe::class);
    // }

    // public function getNoteAttribute($value)
    // {
    //     return number_format($value, 2);
    // }


}
