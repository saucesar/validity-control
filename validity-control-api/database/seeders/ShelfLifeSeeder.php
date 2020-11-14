<?php

namespace Database\Seeders;

use App\Models\ShelfLife;
use Illuminate\Database\Seeder;

class ShelfLifeSeeder extends Seeder
{
    public function run()
    {
        ShelfLife::factory()->times(60)->create();
    }
}
