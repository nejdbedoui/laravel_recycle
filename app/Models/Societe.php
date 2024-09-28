<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societe extends User
{
    use HasFactory;

    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('societe', function (Builder $builder) {
            $builder->where('role', '=', 'societe');
        });
    }

    protected $fillable = ['name', 'email', 'password', 'role', 'image', 'enable', 'telephone', 'matricule', 'adresse'];

    // Relation One-to-Many avec DemandeMatierePremiere
    public function demandesMatierePremiere()
    {
        return $this->hasMany(DemandeMatierePremiere::class);
    }
}
