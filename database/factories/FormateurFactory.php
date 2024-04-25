<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Formateur>
 */
class FormateurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->name,
            'prenom' => $this->faker->name,
            'date_naissance' => $this->faker->date(),
            'sexe' => $this->faker->randomElement(['homme', 'femme']),
            'email' => $this->faker->unique()->safeEmail,
            'telephone' => '+212' . substr($this->faker->unique()->regexify('[0-9]{9}'), 1),
            'adresse' => $this->faker->address,
            'photo' => $this->faker->imageUrl(),
            'user_id' => \App\Models\User::where('role_id', 3)->first(),
        ];
    }
}
