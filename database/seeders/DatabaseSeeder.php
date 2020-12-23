<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        if(env('APP_ENV') == 'local'){
            $this->call(CompanySeeder::class);
            $this->call(ProductSeeder::class);
            $this->call(ExpirationDateSeeder::class);
        }

        DB::table('users')->insert([
            'name' => 'cesar',
            'email' => 'cesar@vc.com',
            'password' => bcrypt('123456'),
            'company_id' => 1,
            'access_granted' => true,
        ]);

        DB::table('companies')->insert([
            'name' => 'MY COMPANY',
            'owner_id' => 1,
        ]);

        if(env('APP_ENV') == 'local'){
            for($i = 1; $i <= 10; $i++){
                DB::table('users')->insert([
                    'name' => "cesar$i",
                    'email' => "cesar$i@vc.com",
                    'password' => bcrypt('123456'),
                    'company_id' => 1,
                    'access_granted' => false,
                ]);
            }
        }
    }
}