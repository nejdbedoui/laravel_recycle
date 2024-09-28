<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDechet extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'recyclable', 'dangereux'];

    // Relation Many-to-One avec Dechet
    public function dechet()
    {
        return $this->belongsTo(Dechet::class);
    }

}
