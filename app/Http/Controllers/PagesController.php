<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CategoriesController;

class PagesController extends Controller
{
    // Common user pages
    public function index(){
        return view("index", [
            "isAuthenticated" => UserController::isAuthenticated(),
            "isAdmin" => UserController::isAdmin(),
        ]);
    }

    // Admin pages
    public function adminIndex(){
        if (UserController::isAdmin()) return view("admin.index");
        else return redirect("/");
    }
    public function adminCategories(){
        if (UserController::isAdmin()) return view("admin.categories", [
            "categories" => CategoriesController::getCategories(),
        ]);
        else return redirect("/");
    }
    public function adminProducts(){
        if (UserController::isAdmin()) return view("admin.products", [
            "categories" => CategoriesController::getCategories(),
            "products" => ProductsController::getProductsWithImages(),
        ]);
        else return redirect("/");
    }
}
