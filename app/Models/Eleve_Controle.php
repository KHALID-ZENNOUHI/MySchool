<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve_Controle extends Model
{
    use HasFactory;

    protected $fillable = ['eleve_id', 'controle_id', 'note'];

    public function eleve()
    {
        return $this->belongsTo(User::class);
    }

    public function controle()
    {
        return $this->belongsTo(Controle::class);
    }
}
