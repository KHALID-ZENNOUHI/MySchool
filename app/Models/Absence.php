<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = ['date_debut', 'date_fin', 'etat', 'justification', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
