<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\Place;
use App\Models\View;
use Illuminate\Support\Facades\File;

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
        try{
            $store = Store::with('places')->with('products')->with('categories')
            ->where('url', $url)->get()[0];
            if ($store['is_suspended']) abort(404);

            $view = new View;
            $view['store_id'] = $store['id'];
            $view ->save();

            return view('customer', [
                'store' => $store
            ]);
        }
        catch(Exception $e) {
            return abort(500);
        }
        
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
        $store = Store::where('user_id', Auth::user()->id)->get()[0];
        $this->checkAdminOwnStore($store);

        //dd($request);

        $data = $this->validate($request, [
            "name"  => "required|string|max:60",
            "description" => "required|string|max:200",
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
            'cover' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            "displayCards" => "nullable",
            "seo" => "json",
            "youtube" => "string|nullable|max:2048",
            "facebook" => "string|nullable|max:2048",
            "twitter" => "string|nullable|max:2048",
            "instagram" => "string|nullable|max:2048",
            "tiktok" => "string|nullable|max:2048",
            "google_maps" => "string|nullable|max:1000",
        ]);

        //dd($data);

        foreach(['dinIn', 'pickUp', 'delivery', 'displayCards'] as $variable)
        {
            if(isset($data[$variable])) $data[$variable] = 1;
            else $data[$variable] = 0;
        }

        if(isset($data['cover'])) {
            $myimage = time() . $request->cover->getClientOriginalName();
            $request->cover->move(public_path('images'), $myimage);
            $data['cover'] = $myimage;

            // update first then delete old image
            $file_path = public_path('images/' . $store['cover']);
            $store->update($data);
            File::delete($file_path);
        }

        if(isset($data['logo'])) {
            $myimage = time() . $request->logo->getClientOriginalName();
            $request->logo->move(public_path('images'), $myimage);
            $data['logo'] = $myimage;

            // update first then delete old image
            $file_path = public_path('images/' . $store['logo']);
            $store->update($data);
            File::delete($file_path);
        }

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
        $this->checkAdminOwnStore($store);
        $store->delete();

        return redirect()->back();
    }

    /** MORE FUNCTIONS */
    /**********************************************/
    public function checkAdminOwnStore($store)
    {
        if(Auth::user()->id != $store['user_id']){
            return abort(401);
        };
    }

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
            ->orWhere('domain', 'LIKE', "%{$search}%")
            ->orWhere('whatsapp', 'LIKE', "%{$search}%")
            ->paginate(8);

        return view('superAdmin.stores', ['stores' => $stores, 'type' => 'search', 'search' => $search]);
    }

    public function editCustomDomain(Request $request)
    {
        try {
            $data = $this->validate($request, [
                "domain"  => "required|string",
                "store_id" => "required|numeric"
            ]);

            
            $store = Store::findOrFail($data['store_id']);

            
            $store->update(['domain' => $data['domain']]);

            return redirect('superAdmin/stores');
        }

        catch(Exception $e)
        {
            $this->message($e->getMessage(), 'alert-danger');
            return redirect('superAdmin/stores');
        }
    }

    public function showCustomDomain(Request $request)
    {
        try{
            $host = request()->getHost();
            if ($host == env('APP_HOST')){
                return view('auth.login');
            }
            else {
                $store = Store::with('places')->with('products')->with('categories')
                    ->where('domain', $host)->get()[0];
                if ($store['is_suspended']) abort(404);

                $view = new View;
                $view['store_id'] = $store['id'];
                $view ->save();

                return view('customer', ['store' => $store]);
            }
        }
        catch(Exception $e) {
            return abort(500);
        }
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
}
