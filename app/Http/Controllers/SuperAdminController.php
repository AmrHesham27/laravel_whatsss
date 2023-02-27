<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SuperAdminController extends Controller
{
    public function showDashboard()
    {
        $views_today = DB::table('views')->count();
        $views_one_day = DB::table('views')->where('created_at', '<=', Carbon::today()->subDays(1))
            ->count();
        $views_two_day = DB::table('views')->where('created_at', '<=', Carbon::today()->subDays(2))
            ->count();
        $views_three_days = DB::table('views')->where('created_at', '<=', Carbon::today()->subDays(3))
            ->count();
        $views_four_days = DB::table('views')->where('created_at', '<=', Carbon::today()->subDays(4))
            ->count();
        $views_five_days = DB::table('views')->where('created_at', '<=', Carbon::today()->subDays(5))
            ->count();
        $views_six_days = DB::table('views')->where('created_at', '<=', Carbon::today()->subDays(6))
            ->count();

        $products_count = DB::table('products')->count();
        $stores_count = DB::table('stores')->count();


        return view('superAdmin.dashboard', [
            'views' =>
            [
                $views_today,
                $views_one_day,
                $views_two_day,
                $views_three_days,
                $views_four_days,
                $views_five_days,
                $views_six_days
            ],
            'products_count' => $products_count,
            'stores_count' => $stores_count
        ]);
    }
}
