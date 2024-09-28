<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chauffeur extends User
{
    use HasFactory;

    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('chauffeur', function (Builder $builder) {
            $builder->where('role', '=', 'chauffeur');
        });
    }

    protected $fillable = ['name', 'email', 'password', 'role', 'image', 'enable', 'telephone', 'matricule'];

    // Relation One-to-Many avec Deplacement
    public function deplacements()
    {
        return $this->hasMany(Deplacement::class);
    }

    // Relation Many-to-Many avec ZoneCollecte
    public function zonesCollecte()
    {
        return $this->belongsToMany(ZoneCollecte::class, 'chauffeur_zone_collecte');
    }
}
