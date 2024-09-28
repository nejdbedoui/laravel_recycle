<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentreRecyclage extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'adresse', 'capacite'];

    // Relation Many-to-One avec AdminCentreRecyclage
    public function admin()
    {
        return $this->belongsTo(AdminCentreRecyclage::class, 'admin_centre_recyclage_id');
    }

    // Relation One-to-Many avec TypeRecyclage
    public function typesRecyclage()
    {
        return $this->hasMany(TypeRecyclage::class);
    }

    // Relation One-to-Many avec MatierePremiere
    public function matieresPremieres()
    {
        return $this->hasMany(MatierePremiere::class);
    }

    // Relation One-to-Many avec DemandeDechet
    public function demandesDechets()
    {
        return $this->hasMany(DemandeDechet::class);
    }

}
