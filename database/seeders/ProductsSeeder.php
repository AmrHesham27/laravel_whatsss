<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'store_id' => 1,
                'name' => 'تي شيرت',
                'desc' => 'اطلاله قويه',
                'price' => 90,
                'image' => 'product_1.jpg',
                'category_id' => 1,
                'discount' => 30,
            ],
            [
                'store_id' => 1,
                'name' => 'تي شيرت',
                'desc' => 'اطلاله قويه',
                'price' => 90,
                'image' => 'product_2.jpg',
                'category_id' => 1,
                'discount' => 30,
            ],
            [
                'store_id' => 1,
                'name' => 'تي شيرت',
                'desc' => 'اطلاله قويه',
                'price' => 90,
                'image' => 'product_3.webp',
                'category_id' => 1,
                'discount' => 30,
            ],
            [
                'store_id' => 1,
                'name' => 'تي شيرت',
                'desc' => 'اطلاله قويه',
                'price' => 90,
                'image' => 'product_4.jpg',
                'category_id' => 1,
                'discount' => 30,
            ],
            [
                'store_id' => 1,
                'name' => 'تي شيرت',
                'desc' => 'اطلاله قويه',
                'price' => 90,
                'image' => 'product_1.jpg',
                'category_id' => 2,
                'discount' => 30,
            ]
        ]);
    }
}
