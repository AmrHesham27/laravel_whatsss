<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ViewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // day 7
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today(),
        ]);
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today(),
        ]);
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today(),
        ]);
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today(),
        ]);
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today(),
        ]);
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today(),
        ]);

        // day 6
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today()->subDays(1),
        ]);
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today()->subDays(1),
        ]);
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today()->subDays(1),
        ]);
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today()->subDays(1),
        ]);
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today()->subDays(1),
        ]);


        // day 5
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today()->subDays(2),
        ]);
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today()->subDays(2),
        ]);
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today()->subDays(2),
        ]);
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today()->subDays(2),
        ]);


        // day 4
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today()->subDays(3),
        ]);
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today()->subDays(3),
        ]);
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today()->subDays(3),
        ]);

        // day 3
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today()->subDays(4),
        ]);
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today()->subDays(4),
        ]);


        // day 2
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today()->subDays(5),
        ]);
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today()->subDays(5),
        ]);


        // day 1
        DB::table('views')->insert([
            'store_id' => 1,
            'created_at' => Carbon::today()->subDays(6),
        ]);
    }
}
