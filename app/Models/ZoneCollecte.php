<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoneCollecte extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'adresse'];

    // Relation Many-to-Many avec Chauffeur
    public function chauffeurs()
    {
        return $this->belongsToMany(Chauffeur::class, 'chauffeur_zone_collecte');
    }

    // Relation One-to-One avec CentreCollecte
    public function centreCollecte()
    {
        return $this->hasOne(CentreCollecte::class);
    }

}
