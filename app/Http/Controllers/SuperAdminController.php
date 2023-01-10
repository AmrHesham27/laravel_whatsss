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
    public function showDashboard()
    {
        return view('superAdmin.dashboard');
    }

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

        return redirect()->back();
    }

    public function unSuspendStore($id)
    {
        $store = Store::findOrFail($id);
        $store['is_suspended'] = false;
        $store->save();

        return redirect()->back();
    }

    public function addStore()
    {
        return view('superAdmin.addStore');
    }

    public function createStore(Request $request)
    {
        try {
            $data = $this->validate($request,[
                "name"  => "required|string|max:60",
                "whatsapp" => "required|string|max:60",
                "email" => "required|email|max:100",
                "password" => "required|min:8",
            ]);

            $user = User::create([
                'name' => 'admin',
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            Store::create([
                'user_id' => $user['id'],
                'whatsapp' => $data['whatsapp'],
                'name' => $data['name'],
            ]);

            $this->message('New Store was added successfully', 'alert-success');

            return redirect()->back();
        }
        catch(Exception $e) {
            if($user){$user->delete();};
            $this->message($e->getMessage(), 'alert-danger');
            return redirect()->back();
        }
            
        
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
