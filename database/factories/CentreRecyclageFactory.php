<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CentreRecyclage>
 */
class CentreRecyclageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->name(100),
            'adresse' => $this->faker->address,
            'capacite' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
