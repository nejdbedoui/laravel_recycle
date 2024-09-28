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
        $adminExists = User::where('email', 'admin@ecocycle.com')->exists();

        if (!$adminExists) {
            User::create([
                'name' => 'Admin EcoCycle',
                'email' => 'admin@ecocycle.com',
                'email_verified_at' => now(),
                'password' => bcrypt('adminecocycle'),
                'role' => 'admin',
                'image' => 'photoProfileAdmin.png',
            ]);
        }
    }
}
