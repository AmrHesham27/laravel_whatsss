<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class StoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
            'name' => 'كوك دوور',
            'user_id' => 2, 
            'url' => 'cook_door',
            'logo' => 'woodmart-building-supplies-logo.svg',  
            'color_1' => 'red',  
            'color_2' => 'blue',  
            'start_time' => Carbon::parse('10:00'),
            'end_time' =>  Carbon::parse('23:00'),
            'is_suspended' => false,
            'whatsapp' => '01551694277'
        ]);
    }
}
