<?php

namespace Database\Seeders;

use App\Models\EmailCategory;
use Illuminate\Database\Seeder;

class EmailCategorySeeder extends Seeder
{
    public function run()
    {
        EmailCategory::factory()->times(100)->create();
    }
}
