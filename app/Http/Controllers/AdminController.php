<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Store;
use Exception;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showDashboard()
    {
        $store_id = Store::where('user_id', Auth::user()->id)->get()[0]['id'];

        $views_today = DB::table('views')->where('store_id', '=', $store_id)->count();
        $views_one_day = DB::table('views')
            ->where('store_id', '=', $store_id)
            ->where('created_at', '<=', Carbon::today()->subDays(1))
            ->count();
        $views_two_day = DB::table('views')
            ->where('store_id', '=', $store_id)
            ->where('created_at', '<=', Carbon::today()->subDays(2))
            ->count();
        $views_three_days = DB::table('views')
            ->where('store_id', '=', $store_id)
            ->where('created_at', '<=', Carbon::today()->subDays(3))
            ->count();
        $views_four_days = DB::table('views')
            ->where('store_id', '=', $store_id)
            ->where('created_at', '<=', Carbon::today()->subDays(4))
            ->count();
        $views_five_days = DB::table('views')
            ->where('store_id', '=', $store_id)
            ->where('created_at', '<=', Carbon::today()->subDays(5))
            ->count();
        $views_six_days = DB::table('views')
            ->where('store_id', '=', $store_id)
            ->where('created_at', '<=', Carbon::today()->subDays(6))
            ->count();
        return view('admin.dashboard', [
            'views' =>
            [
                $views_today,
                $views_one_day,
                $views_two_day,
                $views_three_days,
                $views_four_days,
                $views_five_days,
                $views_six_days
            ]
        ]);
    }

    function addDeliveryPlace(Request $request)
    {
        $data = $this->validate($request, [
            "placeName"  => "required|string|max:60",
            "placePrice" => "required|string|max:60",
        ]);

        $store = Store::where('user_id', Auth::user()->id)->get()[0];

        $new_place = new Place;
        $new_place['name'] = $data['placeName'];
        $new_place['price'] = $data['placePrice'];
        $new_place['store_id'] = $store['id'];

        $new_place->save();

        $places = Place::where('store_id', $store['id'])->get();

        return redirect()->route('adminEditStore', ['store' => $store, 'places' => $places]);
    }

    public function deleteDeliveryPlace($id)
    {
        $store = Store::where('user_id', Auth::user()->id)->get()[0];
        $places = Place::where('store_id', $store['id'])->get();
        $deletedPlace = Place::findOrFail($id);

        $deletedPlace->delete();

        return redirect()->route('adminEditStore', ['store' => $store, 'places' => $places]); 
    }
}
