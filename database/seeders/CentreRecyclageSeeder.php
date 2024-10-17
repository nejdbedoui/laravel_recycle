<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CentreRecyclage;

class CentreRecyclageSeeder extends Seeder
{
    public function run()
    {
        // Create several CentreRecyclage entries
        CentreRecyclage::factory()->count(5)->create();
    }
}
