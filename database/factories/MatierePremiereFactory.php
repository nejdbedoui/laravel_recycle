<?php

    namespace Database\Factories;

    use Illuminate\Database\Eloquent\Factories\Factory;
    use App\Models\MatierePremiere;
    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MatierePremiere>
     */
    class MatierePremiereFactory extends Factory
    {
        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition()
        {
            return [
                'nom' => $this->faker->word(), 
                'quantite' => $this->faker->randomFloat(2, 0, 1000),
                'centre_recyclage_id' => CentreRecyclage::inRandomOrder()->first()->id ?? CentreRecyclage::factory(), 
            
            ];
        }
    }
