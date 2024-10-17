<?php

namespace Database\Seeders;

use App\Models\Societe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocieteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if a Societe with a specific email exists
        $societeEmail = 'eco_cycle@example.com'; // Change this to the desired unique email for the Societe

        $societeExists = Societe::where('email', $societeEmail)->exists();

        if (!$societeExists) {
            Societe::create([
                'name' => 'EcoCycle S.A.',
                'email' => $societeEmail,
                'password' => bcrypt('societe23'),
                'role' => 'societe',
                'image' => 'defaultImage.png', 
                'enable' => true,
                'telephone' => '1234567890',
                'matricule' => '12345678',
                'adresse' => '1 Rue des Écologistes, Paris, France',
            ]);
        }
    }
}
