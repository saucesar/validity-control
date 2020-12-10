<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name' => 'cesar',
            'email' => 'cesar@vc.com',
            'password' => bcrypt('123456'),
        ]);
        
        if(env('APP_ENV') == 'local'){
            $this->call(CompanySeeder::class);
            $this->call(ProductSeeder::class);
            //$this->call(ShelfLifeSeeder::class);            
        }
    }
}