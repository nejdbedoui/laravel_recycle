<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeDechet extends Model
{
    use HasFactory;

    protected $fillable = ['etat', 'quantite', 'centre_recyclage_id', 'dechet_id'];

    protected $table = 'demandes_dechets';

    // Relation Many-to-One avec CentreRecyclage
    public function centreRecyclage()
    {
        return $this->belongsTo(CentreRecyclage::class);
    }

    // Relation One-to-One inverse avec Deplacement
    public function deplacement()
    {
        return $this->hasOne(Deplacement::class);
    }

    // Relation Many-to-One avec Dechet
    public function dechet()
    {
        return $this->belongsTo(Dechet::class);
    }
}
