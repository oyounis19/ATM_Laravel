<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Atm;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Atm>
 */
class AtmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'city' => $this->faker->city,
            'street' => $this->faker->streetAddress,
            'area' => $this->faker->city,
            'balance' => $this->faker->randomNumber(5),
        ];
    }
}
