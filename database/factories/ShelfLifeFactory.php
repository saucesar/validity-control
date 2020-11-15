<?php

namespace Database\Factories;

use App\Models\ShelfLife;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShelfLifeFactory extends Factory
{
    protected $model = ShelfLife::class;

    public function definition()
    {
        return [
            'amount' => $this->faker->numberBetween(1, 100),
            'date' => Carbon::now()->addDays($this->faker->numberBetween(10, 60)),
            'product_id' => $this->faker->numberBetween(1, 30),
        ];
    }
}