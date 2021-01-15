<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'barcode' => $this->faker->numberBetween(10000, 99999).''.$this->faker->numberBetween(10000, 99999).''.$this->faker->numberBetween(100, 999),
            'description' => $this->faker->name,
            'company_id' => 1,
            'category_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}