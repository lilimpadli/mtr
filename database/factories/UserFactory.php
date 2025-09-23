<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),          // sesuai tabel
            'email' => $this->faker->unique()->safeEmail(),
            'no_tlpn' => $this->faker->phoneNumber(),
            'role' => $this->faker->randomElement(['admin','pemilik','penyewa']),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),        // default password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the user's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
