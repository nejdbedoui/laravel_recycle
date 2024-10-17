<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dechet extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'quantite', 'centre_collecte_id', 'type_dechet_id'];

    protected $table = 'dechets';

    // Relation One-to-Many avec DemandeDechet
    public function demandesDechets()
    {
        return $this->hasMany(DemandeDechet::class);
    }

    // Relation Many-to-One avec CentreCollecte
    public function centreCollecte()
    {
        return $this->belongsTo(CentreCollecte::class);
    }

    // Relation Many-to-One avec TypeDechet
    public function typeDechet()
    {
        return $this->belongsTo(TypeDechet::class);
    }
}
