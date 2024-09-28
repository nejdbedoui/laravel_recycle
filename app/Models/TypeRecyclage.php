<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRecyclage extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description'];

    // Relation Many-to-One avec CentreRecyclage
    public function centreRecyclage()
    {
        return $this->belongsTo(CentreRecyclage::class);
    }

}
