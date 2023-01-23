<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use Exception;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = Store::where('user_id', Auth::user()->id)->get()[0];
        $categories = ProductCategory::where('store_id', $store['id'])->paginate(8);
        return view('admin.categories', [
            'categories' => $categories,
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
        return view('admin.addCategory');
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
            ]);

            $store = Store::where('user_id', Auth::user()->id)->get()[0];

            if (ProductCategory::where('store_id', $store['id'])->count() > 49) {
                $this->message('Sorry, You have reached the maximum of 50 categories', 'alert-danger');
                return redirect()->back(); 
            };

            ProductCategory::create([
                'name' => $data['name'],
                'store_id' => $store['id'],
            ]);

            $this->message('New Category was added successfully', 'alert-success');

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
    public function show($id)
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
        //
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
        $data = $this->validate($request, [
            "name"  => "required|string|max:60",
        ]);

        $category = ProductCategory::findOrFail($id);
        $store = Store::where('user_id', Auth::user()->id)->get()[0];

        $this->checkAdminOwnCategory($category, $store);

        $category->update($data);

        $store = Store::where('user_id', Auth::user()->id)->get()[0];
        $categories = ProductCategory::where('store_id', $store['id'])->paginate(8);

        return redirect()->route('adminCategories', [
            'categories' => $categories,
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
        $category = ProductCategory::findOrFail($id);
        $store = Store::where('user_id', Auth::user()->id)->get()[0];

        $this->checkAdminOwnCategory($category, $store);

        $category->delete();

        return redirect()->back();
    }

    /** MORE FUNCTIONS */
    public function checkAdminOwnCategory ($category, $store)
    {
        if($category['store_id'] != $store['id']){
            return abort(401);
        };
    }

    public function searchCategories(Request $request)
    {
        $search = $request->input('search');
        $store = Store::where('user_id', Auth::user()->id)->get()[0];

        $categories = ProductCategory::where('store_id', $store['id'])->where(function ($query) use ($search) {
            $query->where('id', '=', $search)
            ->orWhere('name', 'LIKE', "%{$search}%");
        })->paginate(8);

        return view('admin.categories', ['categories' => $categories, 'type' => 'search', 'search' => $search]);
    }

    public function toggleActivation($id)
    {
        try {
            $category = ProductCategory::findOrFail($id);
            $store = Store::where('user_id', Auth::user()->id)->get()[0];
            $this->checkAdminOwnCategory($category, $store);

            if ($category['active']) {
                $category->update(['active' => 0]);
                $this->message("Category was disabled successfully", 'alert-success');
            } else {
                $category->update(['active' => 1]);
                $this->message("Category was activated successfully", 'alert-success');
            }
            return redirect()->back();
        } catch (Exception $e) {
            $this->message($e->getMessage(), 'alert-danger');
        }
    }
}
