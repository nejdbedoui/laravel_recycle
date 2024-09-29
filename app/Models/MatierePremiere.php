<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatierePremiere extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'quantite'];

    protected $table = 'matiere_premieres';

    // Relation Many-to-One avec CentreRecyclage
    public function centreRecyclage()
    {
        return $this->belongsTo(CentreRecyclage::class);
    }

    // Relation One-to-Many avec DemandeMatierePremiere
    public function demandesMatierePremiere()
    {
        return $this->hasMany(DemandeMatierePremiere::class);
    }
}
