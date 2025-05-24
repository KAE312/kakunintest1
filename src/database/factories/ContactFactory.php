<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
    return [
        'last_name' => $this->faker->lastName,
        'first_name' => $this->faker->firstName,
        'gender' => $this->faker->randomElement([1, 2]),
        'email' => $this->faker->safeEmail,
        'address' => $this->faker->address,
        'building_name' => $this->faker->secondaryAddress,
        'message' => $this->faker->text(100),
        ];
    }
}
