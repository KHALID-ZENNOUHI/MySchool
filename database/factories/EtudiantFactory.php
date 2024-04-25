<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
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
            'date_naissance' => $this->faker->date(),
            'lieu_naissance' => $this->faker->city,
            'sexe' => $this->faker->randomElement(['homme', 'femme']),
            'email' => $this->faker->unique()->safeEmail,
            'telephone' => '+212' . substr($this->faker->unique()->regexify('[0-9]{9}'), 1),
            'adresse' => $this->faker->address,
            'photo' => $this->faker->imageUrl(),
            'responsable_id' => \App\Models\Responsable::factory(),
            'classe_id' => fake()->numberBetween(1, 9),
            'user_id' => \App\Models\User::where('role_id', 4)->first(),
        ];
    }
}
