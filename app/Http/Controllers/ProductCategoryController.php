<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $category->delete();

        return redirect()->back();
    }

    /** MORE FUNCTIONS */
    public function searchCategories(Request $request)
    {
        $search = $request->input('search');

        $categories = ProductCategory::where('id', '=', $search)
            ->orWhere('name', 'LIKE', "%{$search}%")
            ->paginate(8);

        return view('admin.categories', ['categories' => $categories, 'type' => 'search', 'search' => $search]);
    }
}
