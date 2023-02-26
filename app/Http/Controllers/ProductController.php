<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = Store::where('user_id', Auth::user()->id)->get()[0];
        $products = Product::with('category')
            ->where('store_id', $store['id'])->paginate(8);
        
        return view('admin.products', [
            'products' => $products,
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
        $store = Store::where('user_id', Auth::user()->id)->get()[0];
        $categories = ProductCategory::where('store_id', $store['id'])->get();
        return view('admin.addProduct', ['categories' => $categories]);
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
                "desc" => "required|string|max:300",
                "price" => "required|numeric",
                "image" => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
                "category_id" => "required|numeric"
            ]);

            if(isset($data['image'])) {
                $myimage = time() . $request->image->getClientOriginalName();
                $request->image->move(public_path('images'), $myimage);
                $data['image'] = $myimage;
            }

            $store = Store::where('user_id', Auth::user()->id)->get()[0];
            $data['store_id'] = $store['id'];

            if (Product::where('store_id', $store['id'])->count() > 200) {
                $this->message('Sorry, You have reached the maximum of 200 products', 'alert-danger');
                return redirect()->back(); 
            };

            Product::create($data);
            
            $this->message('New Product was added successfully', 'alert-success');

            return redirect()->back();
        } catch (Exception $e) {
            $this->message($e->getMessage(), 'alert-danger');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::with('categories')->where('user_id', Auth::user()->id)->get()[0];
        $product = Product::findOrFail($id);

        $this->checkAdminOwnProduct($product, $store);
        return view('admin.editProduct', ['product' => $product, 'categories' => $store['categories']]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $store = Store::where('user_id', Auth::user()->id)->get()[0];
        $this->checkAdminOwnProduct($product, $store);

        $data = $this->validate($request, [
            "name"  => "required|string|max:60",
            "desc" => "required|string|max:300",
            "price" => "required|numeric",
            "image" => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            "category_id" => "required|numeric"
        ]);

        if(isset($data['image'])) {
            $myimage = time() . $request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $myimage);
            $data['image'] = $myimage;

            // update first then delete old image
            $file_path = public_path('images/' . $product['image']);
            $product->update($data);
            File::delete($file_path);
        }
        else {
            $product->update($data);
        }

        $products = Product::where('store_id', $store['id'])->paginate(8);

        $this->message('Your Product was edited successfully', 'alert-success');

        return redirect()->route('admin.products.index', [
            'products' => $products, 
            'type' => 'data', 
            'search' => ''
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $store = Store::where('user_id', Auth::user()->id)->get()[0];

        $this->checkAdminOwnProduct($product, $store);

        $product->delete();
        $this->message("Product was deleted successfully", 'alert-danger');

        return redirect()->back();
    }

    /** MORE FUNCTIONS */
    public function checkAdminOwnProduct ($product, $store)
    {
        if($product['store_id'] != $store['id']){
            return abort(401);
        };
    }

    public function searchProducts(Request $request)
    {
        $search = $request->input('search');
        $store = Store::where('user_id', Auth::user()->id)->get()[0];

        $products = Product::where('store_id', $store['id'])->where(function ($query) use ($search) {
            $query->where('id', '=', $search)
            ->orWhere('name', 'LIKE', "%{$search}%");
        })->paginate(8);
            
        return view('admin.products', ['products' => $products, 'type' => 'search', 'search' => $search]);
    }

    public function toggleActivation($id)
    {
        try {
            $product = Product::findOrFail($id);
            $store = Store::where('user_id', Auth::user()->id)->get()[0];
            if($product['store_id'] != $store['id']){
                return abort(401);
            };

            if ($product['active'])
            {
                $product->update([ 'active' => 0 ]);
                $this->message("Product was disabled successfully", 'alert-success');
            }
            else 
            {
                $product->update([ 'active' => 1 ]);
                $this->message("Product was activated successfully", 'alert-success');
            }    
            return redirect()->back();
        }
        catch (Exception $e)
        {
            $this->message($e->getMessage(), 'alert-danger');
        }
    }
}
