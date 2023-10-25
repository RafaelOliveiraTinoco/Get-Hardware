<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $request->validate([
            "name" => ["required", "min:2"],
            "email" => ["email", "required", "unique:users,email"],
            "password" => ["required", "min:8"],
        ]);

        // create new user
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 0;
        $user->save();

        return redirect()->back();
    }

    public function login(Request $request){
        $request->validate([
            "email" => ["required"],
            "password" => ["required"],
        ]);

        $credentials = $request->only("email", "password");
        if(Auth::attempt($credentials)) return redirect()->back();
        else return redirect()->back()->withErrors(["email" => "Invalid credentials!"]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/");
    }

    public static function isAuthenticated(){
        return Auth::check(); // returns true if the user is authenticated, and false if the user is not authenticated
    }
}
