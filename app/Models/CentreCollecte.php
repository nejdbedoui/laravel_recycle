<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentreCollecte extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'adresse', 'capacite'];

    // Relation One-to-One inverse avec ZoneCollecte
    public function zoneCollecte()
    {
        return $this->belongsTo(ZoneCollecte::class);
    }

    // Relation One-to-One inverse avec AdminCentreCollecte
    public function adminCentreCollecte()
    {
        return $this->belongsTo(AdminCentreCollecte::class, 'admin_centre_collecte_id');
    }

    // Relation One-to-Many avec Dechet
    public function dechets()
    {
        return $this->hasMany(Dechet::class);
    }
}
