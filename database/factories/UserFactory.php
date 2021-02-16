<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'company_id' => 1,
            'role' => $this->faker->boolean() ? 'owner' : 'employee',
            'access_granted' => $this->faker->boolean(),
            'password' => bcrypt('123456'),
            'remember_token' => Str::random(10),
        ];
    }
}
