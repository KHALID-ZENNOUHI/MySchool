<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrateur extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'email', 'telephone', 'adresse', 'date_naissance', 'sexe', 'photo', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
