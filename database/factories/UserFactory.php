<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Provider\en_US\Person;
use Faker\Factory as Faker;

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

    public function definition()
    {
        $faker = Faker::create();
        return [
            'name' => fake()->name(),
            'role' => 'user',
            'email' => fake()->unique()->safeEmail(),
            'surname' => $faker->lastName(),
            'user_name' => $faker->userName(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi', // password
            'remember_token' => Str::random(10),
            'image' => 'ejemplo.png',
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
}
