<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Store;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class AdminController extends Controller
{
    public function showDashboard()
    {
        $store = Store::where('user_id', Auth::user()->id)->get()[0];
        $store_id = $store['id'];
        $store_url = $store['url'];

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

        $categories_count = DB::table('products_categories')->where('store_id', '=', $store_id)->count();
        $products_count = DB::table('products')->where('store_id', '=', $store_id)->count();
        return view('admin.dashboard', [
            'categories_count' => $categories_count,
            'products_count' => $products_count,
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
            'store_url' => URL::to('/') . '/stores/' .$store_url
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

        $deletedPlace = Place::where('store_id', $store['id'])->where('id', $id)->get()[0];

        $deletedPlace->delete();

        return redirect()->route('adminEditStore', ['store' => $store, 'places' => $places]); 
    }

    /** SEO of the store */
    public function addMeta(Request $request)
    {
        try {
            $data = $this->validate($request, [
                "name"  => "required|string",
            ]);
            $store = Store::where('user_id', Auth::user()->id)->get()[0];
            $seo = json_decode($store['seo'], true);

            $seo[$data['name']] = ['name' => $data['name']];

            $store->update(['seo' => json_encode($seo)]);
            $this->message('Meta tag was added successfully', 'alert-success');
            return redirect()->back();
        }
        catch (Exception $e){
            $this->message($e->getMessage(), 'alert-danger');
            return redirect()->back();
        }
    }

    public function deleteMeta(Request $request)
    {
        try {
            $data = $this->validate($request, [
                "name"  => "required|string",
            ]);
            $store = Store::where('user_id', Auth::user()->id)->get()[0];
            $seo = json_decode($store['seo'], true);

            if (isset($seo[$data['name']])){
                unset($seo[$data['name']]);
            };
            
            $store->update(['seo' => json_encode($seo)]);
            $this->message('Meta tag was deleted successfully', 'alert-success');
            return redirect()->back();
        }
        catch (Exception $e){
            $this->message($e->getMessage(), 'alert-danger');
        }
    }
}
