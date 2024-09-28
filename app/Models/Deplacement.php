<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deplacement extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'etat'];

    // Relation Many-to-One avec Chauffeur
    public function chauffeur()
    {
        return $this->belongsTo(Chauffeur::class);
    }

    // Relation One-to-One avec DemandeDechet
    public function demandeDechet()
    {
        return $this->hasOne(DemandeDechet::class);
    }
}
