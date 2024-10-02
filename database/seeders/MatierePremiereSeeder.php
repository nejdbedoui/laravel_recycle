<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MatierePremiere;
use App\Models\CentreRecyclage;

class MatierePremiereSeeder extends Seeder
{
    public function run()
    {
        $centres = CentreRecyclage::all(); 

        foreach ($centres as $centre) {
            MatierePremiere::create([
                'nom' => 'Plastique',
                'quantite' => 1000,
                'centre_recyclage_id' => $centre->id,
            ]);
        }
    }
}
