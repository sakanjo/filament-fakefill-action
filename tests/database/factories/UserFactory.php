<?php

namespace SaKanjo\FilamentFakeFillAction\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use SaKanjo\FilamentFakeFillAction\Tests\Models\User;

use function SaKanjo\FilamentFakeFillAction\isFakeFilling;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => isFakeFilling() ? 'Name from factory' : $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'state' => isFakeFilling() ? 'State from factory' : $this->faker->sentence(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
