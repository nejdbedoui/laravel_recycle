<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCentreRecyclage extends User
{
    use HasFactory;

    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('adminCentreRecyclage', function (Builder $builder) {
            $builder->where('role', '=', 'adminCentreRecyclage');
        });
    }

    protected $fillable = ['name', 'email', 'password', 'role', 'image', 'enable', 'telephone', 'matricule'];

    // Relation One-to-One avec CentreRecyclage
    public function centreRecyclage()
    {
        return $this->hasOne(CentreRecyclage::class);
    }

}
