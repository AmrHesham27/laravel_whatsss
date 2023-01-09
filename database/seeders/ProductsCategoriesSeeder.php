<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_categories')->insert([
            [
                'name' => 'تي شيرتات',
                'store_id' => 1
            ], 
            [
                'name' => 'مجموعة الصيف',
                'store_id' => 1
            ]
        ]);
    }
}
