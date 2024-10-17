<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Societe;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Societe>
 */
class SocieteFactory extends Factory
{
    protected $model = Societe::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('societe23'),
            'role' => 'societe',
            'image' => $this->faker->imageUrl(), // Generate a random image URL
            'enable' => $this->faker->boolean,
            'telephone' => $this->faker->phoneNumber,
            'matricule' => $this->faker->unique()->randomNumber(8),
            'adresse' => $this->faker->address,
        ];
    }
}
