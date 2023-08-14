<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Account;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition()
    {
        $randomNumber = $this->faker->numberBetween(10000000000000, 99999999999999); // Generates a 14-digit number

        $formattedNumber = str_pad($randomNumber, 14, '0', STR_PAD_LEFT); // Pad with zeros to make it 14 digits

        return [
            'ssn' => $formattedNumber,
            'balance' => $this->faker->randomNumber(5),
            'type' => $this->faker->randomElement(['saving', 'gold', 'current']),
            'state' => $this->faker->randomElement(['running', 'blocked']),
        ];
    }
}
