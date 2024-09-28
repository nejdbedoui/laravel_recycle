<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCentreCollecte extends User
{
    use HasFactory;

    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('adminCentreCollecte', function (Builder $builder) {
            $builder->where('role', '=', 'adminCentreCollecte');
        });
    }

    protected $fillable = ['name', 'email', 'password', 'role', 'image', 'enable', 'telephone', 'matricule'];

    // Relation One-to-One avec CentreCollecte
    public function centreCollecte()
    {
        return $this->hasOne(CentreCollecte::class);
    }
}
