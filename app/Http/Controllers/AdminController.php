<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function loginPage(Request $request){
        return view("admin.login");
    }
}
