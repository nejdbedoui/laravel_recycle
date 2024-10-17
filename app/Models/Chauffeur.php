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



    // Définir la méthode pour récupérer les chauffeurs disponibles pour une date spécifique
    public static function getAvailableDrivers($date)
    {
        $chauffeursIndisponibles = Deplacement::where('date', $date)
            ->pluck('chauffeur_id');

        // Retourner les chauffeurs qui ne sont pas déjà assignés à cette date
        return self::whereNotIn('id', $chauffeursIndisponibles)->get();
    }

    public static function getAvailableDriversForUpdate($date, $deplacementId)
    {
        // Récupérer les chauffeurs assignés à un déplacement à la date donnée, excluant le déplacement en cours
        $chauffeursIndisponibles = Deplacement::where('date', $date)
            ->where('id', '!=', $deplacementId) // Exclure le déplacement actuel
            ->pluck('chauffeur_id');

        // Retourner les chauffeurs qui ne sont pas déjà assignés à cette date
        return Chauffeur::whereNotIn('id', $chauffeursIndisponibles)->get();
    }


}
