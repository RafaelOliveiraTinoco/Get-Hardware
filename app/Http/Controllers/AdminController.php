<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginPage(Request $request){
        if(self::isAuthenticated()) return view("admin.panel");
        else return view("admin.login");
    }

    public function login(Request $request){
        $request->validate([
            "email" => ["email", "required"],
            "password" => ["required"],
        ]);

        $credentials = $request->only("email", "password");

        if(Auth::guard("admin")->attempt($credentials)) return redirect()->back(); // if login successful go back to /admin route
        else return redirect()->back()->withErrors(["email" => "Invalid credentials!"]); // else go back to /admin route with errors
    }

    public function logout(Request $request){
        Auth::guard("admin")->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/admin");
    }

    public static function isAuthenticated(){
        return Auth::guard("admin")->check(); // returns true if the user is authenticated, and false if the user is not authenticated
    }
}
