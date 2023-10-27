<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // Common user pages
    public function index(Request $request){
        return view("index", [
            "isAuthenticated" => UserController::isAuthenticated(),
            "isAdmin" => UserController::isAdmin(),
        ]);
    }

    // Admin pages
    public function adminIndex(Request $request){
        if (UserController::isAdmin()) return view("admin.index");
        else return redirect("/");
    }

    public function adminCategories(Request $request){
        if (UserController::isAdmin()) return view("admin.categories");
        else return redirect("/");
    }
}
