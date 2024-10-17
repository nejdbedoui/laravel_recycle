<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin EcoCycle if it doesn't exist
        $adminExists = User::where('email', 'admin@ecocycle.com')->exists();

        if (!$adminExists) {
            User::create([
                'name' => 'Admin EcoCycle',
                'email' => 'admin@ecocycle.com',
                'email_verified_at' => now(),
                'password' => bcrypt('adminecocycle'),
                'role' => 'admin',
                'image' => 'photoProfile.png',
            ]);
        }

        // Create Admin Centre Recyclage if it doesn't exist
        $adminCentreRecyclageExists = User::where('email', 'adminCentreRecyclage@ecocycle.com')->exists();

        if (!$adminCentreRecyclageExists) {
            User::create([
                'name' => 'Admin Centre Recyclage',
                'email' => 'adminCentreRecyclage@ecocycle.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admincentrecycle'),
                'role' => 'adminCentreRecyclage',
                'image' => 'photoProfile.png',
                'telephone' => '0123456789',
                'matricule' => '123456789',
            ]);
        }
    }
}
