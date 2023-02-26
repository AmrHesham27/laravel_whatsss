<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use App\Models\Coupon;
use Exception;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = Store::where('user_id', Auth::user()->id)->get()[0];
        $coupons = Coupon::where('store_id', $store['id'])->paginate(8);

        return view('admin.coupons', [
            'coupons' => $coupons,
            'type' => 'data',
            'search' => ''
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addCoupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $store = Store::where('user_id', Auth::user()->id)->get()[0];
            $data = $this->validate($request, [
                "type" => "required|in:percent,flat",
                "amount" => "required|numeric",
                "code" => "required|max:30"
            ]);
            $data['store_id'] = $store['id'];

            if (Coupon::where('store_id', $store['id'])->where('code', $data['code'])->count() > 0){
                $this->message('You already has a coupon with this name', 'alert-danger');
                return redirect()->back();
            }

            Coupon::create($data);
            $this->message('New Coupon was added successfully', 'alert-success');
            return redirect()->back();
        } catch (Exception $e) {
            $this->message($e->getMessage(), 'alert-danger');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $store = Store::where('user_id', Auth::user()->id)->get()[0];
            $coupon = Coupon::findOrFail($id);
            $this->checkAdminOwnCoupon($coupon, $store);
            return view('admin.editCoupon', ['coupon' => $coupon]);
        } catch (\Exception $e) {
            $this->message($e->getMessage(), 'alert-danger');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $store = Store::where('user_id', Auth::user()->id)->get()[0];
        $coupon = Coupon::findOrFail($id);
        $this->checkAdminOwnCoupon($coupon, $store);

        $data = $this->validate($request, [
            "type" => "required|in:percent,flat",
            "amount" => "required|numeric",
            "code" => "required|max:30"
        ]);

        if (Coupon::where('store_id', $store['id'])->where('code', $data['code'])->count() > 0){
            $this->message('You already has a coupon with this name', 'alert-danger');
            return redirect()->back();
        }

        $coupon->update($data);

        $this->message('Your Coupon was edited successfully', 'alert-success');
        $coupons = Coupon::where('store_id', $store['id'])->paginate(8);

        return redirect()->route('admin.coupons.index', [
            'coupons' => $coupons, 
            'type' => 'data',
            'search' => ''
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $store = Store::where('user_id', Auth::user()->id)->get()[0];
        $this->checkAdminOwnCoupon($coupon, $store);

        $coupon->delete();
        return redirect()->back();
    }

    // MORE FUNCTIONS
    public function checkAdminOwnCoupon($coupon, $store)
    {
        if ($coupon['store_id'] != $store['id']) {
            return abort(401);
        };
    }

    public function searchCoupons(Request $request)
    {
        $search = $request->input('search');
        $store = Store::where('user_id', Auth::user()->id)->get()[0];

        $coupons = Coupon::where('store_id', $store['id'])->where(function ($query) use ($search) {
            $query->where('id', '=', $search)
            ->orWhere('code', 'LIKE', "%{$search}%");
        })->paginate(8);
            
        return view('admin.coupons', ['coupons' => $coupons, 'type' => 'search', 'search' => $search]);
    }

    public function applyCoupon(Request $request)
    {
        try {
            $data = $this->validate($request, [
                "store_id" => "required",
                "code" => "required",
            ]);
            $coupon = Coupon::where('code', $data['code'])
                ->where('store_id', $data['store_id'])->get()[0];
            return response()->json([
                "status" => true,
                "data" => $coupon
            ]);
        }
        catch (Exception $e)
        {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
