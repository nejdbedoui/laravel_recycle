<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRecyclage extends Model
{
    use HasFactory;

    protected $table = 'type_recyclages';

    //protected $fillable = ['nom', 'description'];
    protected $fillable = ['nom', 'description', 'centre_recyclage_id'];


    // Relation Many-to-One avec CentreRecyclage
    public function centreRecyclage()
    {
        return $this->belongsTo(CentreRecyclage::class);
    }

}
