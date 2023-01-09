<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Store;
use Exception;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function test($id)
    {
        dd(count(Store::where('user_id', '==', auth()->user()->id)->get()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string',
            'url' => 'required|string',
            'logo' => 'required',
            'color1' => 'required|string',
            'color_2' => 'required|string',
            'minimum_order' => 'required|numeric',
            'start_time' => 'required|time',
            'end_time' =>  'required|time',
            'delievry_time' => 'required|numeric',
            'delivery_fees' => 'required|numeric',
        ]);

        $data['user_id'] = auth()->user()->id;

        if (count(Store::where('user_id', '==', auth()->user()->id)->get())) {
            abort(500, "This account already has a store");
        }

        if (count(Store::where('url', '==', $data['url'])->get())) {
            abort(
                500,
                "This URL is already taken, try another URL or use a custome domain."
            );
        }

        Store::create($data);

        return redirect();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = Store::where('url', $id)->get()[0];
        return view('customer', ['store' => $store]);
    }

    /** API to check valid url */
    public function checkURL($url)
    {
        try {
            $stores = Store::where('url' , $url)->get();
            $result = true;
            if (count($stores)) $result = false;
            return response()->json([
                "status" => true,
                "result" => $result
            ], 200); 
        }
        catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ], 500); 
        } 
    }

    /** API to get categories and products */
    public function getStoreProducts($id)
    {
        try {
            $products = ProductCategory::with('products')
                ->where('store_id', $id)->get();
            return response()->json([
                "status" => true,
                "data" => $products,
            ], 200);
        }
        catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Display the specified resource dashbaord.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDashboard($name)
    {
        $store = Store::where('name', $name);
        return view('storeAdmin', ['store' => $store]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        $data = $this->validate($request, [
            'name' => 'nullable|string',
            'url' => 'nullable|string',
            'logo' => 'nullable',
            'color1' => 'nullable|string',
            'color_2' => 'nullable|string',
            'minimum_order' => 'nullable |numeric',
            'start_time' => 'nullable|time',
            'end_time' =>  'nullable|time',
            'delievry_time' => 'nullable|numeric',
            'delivery_fees' => 'nullable|numeric',
        ]);

        $store = Store::where('name', $data['name'])->get()[0];

        if (auth()->user()->id != $store['user_id'] ) {
            abort(
                500,
                "You do not have this store."
            );
        }

        if (count(Store::where('url', '==', $data['url'])->get()) && $data['url']) {
            abort(
                500,
                "This URL is already taken, try another URL or use a custome domain."
            );
        }

        $store->update($data);

        return redirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$this->is_super_admin(auth()->user()->email)) {
            abort(
                500,
                "Only Admin can do that"
            );
        }

        $store = Store::findOrFail($id);
        $store->delete($id);   
    }
}
