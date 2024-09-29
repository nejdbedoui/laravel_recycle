<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDechet extends Model
{
    use HasFactory;

    protected $table = 'type_dechets';

    protected $fillable = ['nom', 'description', 'recyclable', 'dangereux'];

    // Relation One-to-Many avec Dechet
    public function dechets()
    {
        return $this->hasMany(Dechet::class);
    }

}
