<?php

namespace Database\Factories;

use App\Models\ExpirationDate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExpirationDateFactory extends Factory
{

    protected $model = ExpirationDate::class;

    public function definition()
    {
        return [
            'date' => Carbon::now()->addDays($this->faker->numberBetween(10, 60)),
            'amount' => $this->faker->numberBetween(100, 999),
            'lote' => Str::random(10),
            'product_id' => $this->faker->numberBetween(1, 99),
            'user_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
