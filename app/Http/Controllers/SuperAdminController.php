<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SuperAdminController extends Controller
{
    public function showRegisterStore()
    {
        return view();
    }

    public function isSuperAdmin(Request $request)
    {
        //dd(env('SUPER_ADMIN_EMAIL'));
        //dd(Auth::user()->email);
        if (env('SUPER_ADMIN_EMAIL') === Auth::user()->email) return true;
        else return false;
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
