<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use App\Models\Card;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    protected $model = Card::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => Card::generateCardInfo()['id'],
            'exp_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
            'cvv' => $this->faker->randomNumber(3),
            'state' => $this->faker->randomElement(['running', 'blocked']),
        ];
    }
}
