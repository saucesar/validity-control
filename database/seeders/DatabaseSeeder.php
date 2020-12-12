<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
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

        if(env('APP_ENV') == 'local'){
            DB::table('users')->insert([
                'name' => 'cesar2',
                'email' => 'cesar2@vc.com',
                'password' => bcrypt('123456'),
                'company_id' => 1,
                'access_granted' => true,
            ]);

            DB::table('users')->insert([
                'name' => 'cesar3',
                'email' => 'cesar3@vc.com',
                'password' => bcrypt('123456'),
                'company_id' => 1,
                'access_granted' => false,
            ]);

            DB::table('users')->insert([
                'name' => 'cesar4',
                'email' => 'cesar4@vc.com',
                'password' => bcrypt('123456'),
                'company_id' => 1,
                'access_granted' => false,
            ]);
        }
    }
}