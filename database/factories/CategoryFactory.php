<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'send_to' => [$this->faker->email, $this->faker->email],
            'company_id' => 1,
        ];
    }
}
