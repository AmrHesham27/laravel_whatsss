<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use App\Models\User;
use App\Models\View;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SuperAdminController extends Controller
{
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

    public function showDashboard()
    {
        $views_today = DB::table('views')->count();
        $views_one_day = DB::table('views')->where('created_at', '<=', Carbon::today()->subDays(1))
            ->count();
        $views_two_day = DB::table('views')->where('created_at', '<=', Carbon::today()->subDays(2))
            ->count();
        $views_three_days = DB::table('views')->where('created_at', '<=', Carbon::today()->subDays(3))
            ->count();
        $views_four_days = DB::table('views')->where('created_at', '<=', Carbon::today()->subDays(4))
            ->count();
        $views_five_days = DB::table('views')->where('created_at', '<=', Carbon::today()->subDays(5))
            ->count();
        $views_six_days = DB::table('views')->where('created_at', '<=', Carbon::today()->subDays(6))
            ->count();
        return view('superAdmin.dashboard', [
            'views' =>
            [
                $views_today,
                $views_one_day,
                $views_two_day,
                $views_three_days,
                $views_four_days,
                $views_five_days,
                $views_six_days
            ]
        ]);
    }

    public function showAllStores(Request $request)
    {
        $stores = Store::paginate(8);
        return view('superAdmin.stores', ['stores' => $stores, 'type' => 'data', 'search' => '']);
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
            $data = $this->validate($request, [
                "name"  => "required|string|max:60",
                "whatsapp" => "required|string|max:60",
                "email" => "required|email|max:100",
                "password" => "required|min:8",
            ]);

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
            ]);

            $this->message('New Store was added successfully', 'alert-success');

            return redirect()->back();
        } catch (Exception $e) {
            if ($id) {
                $user = User::findOrFail($id);
                $user->delete();
            };
            $this->message($e->getMessage(), 'alert-danger');
            return redirect()->back();
        }
    }


    public function registerStoreOwner(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
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
