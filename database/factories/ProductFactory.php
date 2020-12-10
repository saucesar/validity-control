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
            'company_id' => $this->faker->numberBetween(1, 30),
            'expiration_dates' => [
                [
                    'date' => Carbon::now()->addDays($this->faker->numberBetween(10, 60))->format('d-m-Y'),
                    'amount' => $this->faker->numberBetween(10, 999),
                ],
                [
                    'date' => Carbon::now()->addDays($this->faker->numberBetween(10, 60))->format('d-m-Y'),
                    'amount' => $this->faker->numberBetween(10, 999),
                ],
            ],
        ];
    }
}