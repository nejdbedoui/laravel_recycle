<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    // Les attributs mass assignables
    protected $fillable = ['description', 'email', 'evenement_communautaire_id'];

    // Relation Many-to-One avec EvenementCommunautaire
    public function evenementCommunautaire()
    {
        return $this->belongsTo(EvenementCommunautaire::class);
    }
}
