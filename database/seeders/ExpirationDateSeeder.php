<?php

namespace Database\Seeders;

use App\Models\ExpirationDate;
use Illuminate\Database\Seeder;

class ExpirationDateSeeder extends Seeder
{
    public function run()
    {
        ExpirationDate::factory()->times(200)->create();
        ExpirationDate::factory(['updated_at' => now()->subDays(2)])->times(20)->create();
    }
}
