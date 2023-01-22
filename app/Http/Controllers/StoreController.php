<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\Place;
use App\Models\ProductCategory;
use App\Models\View;
class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::paginate(8);
        return view('superAdmin.stores', ['stores' => $stores, 'type' => 'data', 'search' => '']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superAdmin.addStore');
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
            $data = $this->validate($request, [
                "name"  => "required|string|max:60",
                "whatsapp" => "required|string|max:60",
                "email" => "required|email|max:100|unique:users",
                "password" => "required|min:8",
                "url" => "required|string|max:60|unique:stores"
            ]);

            if (!ctype_alpha($data['url'])) {
                $this->message('URL must contain only letters', 'alert-danger');
                return redirect()->back();
            }

            $id = User::create([
                'name' => 'admin',
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'created_at' => now(),
                'updated_at' => now()
            ])->id;

            Store::create([
                'user_id' => $id,
                'whatsapp' => $data['whatsapp'],
                'name' => $data['name'],
                'url' => $data['url']
            ]);

            $this->message('New Store was added successfully', 'alert-success');

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
    public function show($url)
    {
        if (!Store::where('url', $url)->count())
        {
            dd('THERE IS NO STORE ON THIS URL');
        };
        $store = Store::where('url', $url)->get()[0];
        if ($store['is_suspended']) abort(404);
        $categories = ProductCategory::with('products')
            ->where('active', true)
            ->where('store_id', $store['id'])->get();

        $products = [];
        foreach($categories as $category)
        {
            array_push($products, $category['products']);
        }
        
        $store['products'] = $products;
        $store['categories'] = $categories;

        $view = new View;
        $view['store_id'] = $store['id'];
        $view ->save();

        $places = Place::where('store_id', $store['id'])->get();
        $store['places'] = $places;

        return view('customer', ['store' => $store]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $store = Store::where('user_id', Auth::user()->id)->get()[0];
        $places = Place::where('store_id', $store['id'])->get();
        return view('admin/editStore', ['store' => $store, 'places' => $places]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $this->validate($request, [
            "name"  => "required|string|max:60",
            "whatsapp" => "required|string|max:60",
            "url" => "required|string|max:60",
            "color_1" => "required",
            "color_2" => "required",
            "start_time" => "required",
            "end_time" => "required",
            "currency" => "required|string",
            "dinIn" => "nullable",
            "pickUp" => "nullable",
            "delivery" => "nullable",
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            "displayCards" => "nullable"
        ]);

        foreach(['dinIn', 'pickUp', 'delivery', 'displayCards'] as $variable)
        {
            if(isset($data[$variable])) $data[$variable] = 1;
            else $data[$variable] = 0;
        }

        if(isset($data['logo'])) {
            $myimage = time() . $request->logo->getClientOriginalName();
            $request->logo->move(public_path('images'), $myimage);
            $data['logo'] = $myimage;
        }

        $store = Store::where('user_id', Auth::user()->id)->get()[0];
        $store->update($data);

        $places = Place::where('store_id', $store['id'])->get();

        $this->message('Your Store was edited successfully', 'alert-success');
        return redirect()->route('adminEditStore', ['store' => $store, 'places' => $places]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();

        return redirect()->back();
    }

    /** MORE FUNCTIONS */
    /**********************************************/
    public function suspendStore($id)
    {
        $store = Store::findOrFail($id);
        $store['is_suspended'] = true;
        $store->save();

        return redirect()->back();
    }

    public function unSuspendStore($id)
    {
        $store = Store::findOrFail($id);
        $store['is_suspended'] = false;
        $store->save();

        return redirect()->back();
    }

    public function searchStores(Request $request)
    {
        $search = $request->input('search');

        $stores = Store::where('id', '=', $search)
            ->orWhere('name', 'LIKE', "%{$search}%")
            ->orWhere('url', 'LIKE', "%{$search}%")
            ->orWhere('subdomain', 'LIKE', "%{$search}%")
            ->orWhere('whatsapp', 'LIKE', "%{$search}%")
            ->paginate(8);

        return view('superAdmin.stores', ['stores' => $stores, 'type' => 'search', 'search' => $search]);
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
}
