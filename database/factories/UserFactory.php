<?php

namespace Database\Factories;

use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;

    public function definition()
    {
        $randomNumber = $this->faker->numberBetween(10000000000000, 99999999999999); // Generates a 14-digit number

        $formattedNumber = str_pad($randomNumber, 14, '0', STR_PAD_LEFT); // Pad with zeros to make it 14 digits

        return [
            'ssn' => $formattedNumber,
            'card_id' => Card::factory()->create()->id,
            'fingerprint' => $this->faker->sha256,
            'password' => Hash::make('password'),
            'name' => $this->faker->name,
            'street' => $this->faker->streetAddress,
            'area' => $this->faker->city,
            'city' => $this->faker->city,
            'email' => $this->faker->unique()->safeEmail,
            'phone_num' => $this->faker->phoneNumber,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $user->card()->save(Card::factory()->create());
        });
    }
}
