<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeMatierePremiere extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'etat', 'quantite'];

    // Relation Many-to-One avec Societe
    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    // Relation Many-to-One avec MatierePremiere
    public function matierePremiere()
    {
        return $this->belongsTo(MatierePremiere::class);
    }
}
