<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deplacement extends Model
{
    use HasFactory;

    protected $table = 'deplacements';

    protected $fillable = ['date', 'etat', 'chauffeur_id', 'demande_dechet_id'];

    // Relation Many-to-One avec Chauffeur
    public function chauffeur()
    {
        return $this->belongsTo(Chauffeur::class);
    }

    // Relation One-to-One avec DemandeDechet
    public function demandeDechet()
    {
        return $this->belongsTo(DemandeDechet::class);
    }
}
