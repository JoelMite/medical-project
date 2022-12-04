<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'lastname' => fake()->lastname(),
            'phone' => fake()->tollFreePhoneNumber(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'age' => mt_rand(1,50),
            'etnia' => fake()->randomElement(['Mestizo','Indigena','Afroamericano']),
            'sex' => fake()->randomElement(['Masculino','Femenino']),
        ];
    }
}
