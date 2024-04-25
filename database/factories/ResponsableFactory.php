<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Responsable>
 */
class ResponsableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'sexe' => $this->faker->randomElement(['homme', 'femme']),
            'cin' => $this->faker->unique()->regexify('[A-Za-z]{2}[0-9]{6}'),
            'telephone' => '+212' . substr($this->faker->unique()->regexify('[0-9]{9}'), 1),
            'adresse' => $this->faker->address,
        ];
    }
}
