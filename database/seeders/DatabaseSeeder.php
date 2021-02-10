<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'MY COMPANY',
            'owner_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'cesar',
            'email' => 'cesar@vc.com',
            'password' => bcrypt('123456'),
            'company_id' => 1,
            'access_granted' => true,
            'email_verified_at' => now(),
        ]);
        
        if(env('APP_ENV') == 'local'){
            $this->call(CategorySeeder::class);
            $this->call(EmailCategorySeeder::class);
        }

        for($i = 1; $i <= 10; $i++){
            DB::table('users')->insert([
                'name' => "cesar$i",
                'email' => "cesar$i@vc.com",
                'password' => bcrypt('123456'),
                'company_id' => 1,
                'access_granted' => false,
                'email_verified_at' => now(),
            ]);

            \App\Models\Product::create([
                'barcode' => "78911112222$i",
                'description' => Str::random(),
                'company_id' => 1,
                'category_id' => 1,
            ]);
        }

        if(env('APP_ENV') == 'local'){
            $this->call(CompanySeeder::class);
            $this->call(ProductSeeder::class);
            $this->call(ExpirationDateSeeder::class);
        }
    }
}