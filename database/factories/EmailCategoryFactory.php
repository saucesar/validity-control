<?php

namespace Database\Factories;

use App\Models\EmailCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailCategoryFactory extends Factory
{
    protected $model = EmailCategory::class;

    public function definition()
    {
        return [
            'email' => $this->faker->email,
            'category_id' => $this->faker->numberBetween(1, 30),
        ];
    }
}
