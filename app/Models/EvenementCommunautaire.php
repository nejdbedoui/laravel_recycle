<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvenementCommunautaire extends Model
{
    use HasFactory;

    protected $table = 'evenements_communautaires';

    protected $fillable = ['nom', 'description', 'date', 'image'];

    // Relation One-to-Many avec Commentaire
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
}
