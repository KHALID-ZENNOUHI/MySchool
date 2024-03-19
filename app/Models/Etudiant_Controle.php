<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant_Controle extends Model
{
    use HasFactory;

    protected $fillable = ['etudiant_id', 'controle_id', 'note'];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function controle()
    {
        return $this->belongsTo(Controle::class);
    }
}
