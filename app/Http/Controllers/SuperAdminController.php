<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SuperAdminController extends Controller
{
    public function showAllStores(Request $request)
    {
        $stores = Store::paginate(8);
        return view('superAdmin.stores', ['stores' => $stores]);
    }

    public function deleteStore($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();

        return redirect()->back();
    }

    public function suspendStore($id)
    {
        $store = Store::findOrFail($id);
        $store['is_suspended'] = true;
        $store->save();

        return redirect()->route('superAdminStores');
    }

    public function unSuspendStore($id)
    {
        $store = Store::findOrFail($id);
        $store['is_suspended'] = false;
        $store->save();

        return redirect()->back();
    }


    public function registerStoreOwner(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Store::create([
            'name' => $request['store_name'],
            'whatsapp' => $request['whatsapp'],
            'user_id' => $user['id']
        ]);
    }
}
