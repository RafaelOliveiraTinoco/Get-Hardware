<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;

class PagesController extends Controller
{
    // Common user pages
    public function index(){
        return view("index", [
            "isAuthenticated" => UserController::isAuthenticated(),
            "isAdmin" => UserController::isAdmin(),

            "pageTitle" => "GetHardware",

            "categories" => CategoriesController::getCategories(),

            "products" => ProductsController::getProducts(),
            "categoriesWithProducts" => CategoriesController::getCategoriesWithProducts(),
        ]);
    }

    // Admin pages
    public function adminIndex(){
        if (UserController::isAdmin()) return view("admin.index", [
            "pageTitle" => "Admin Panel",
        ]);
        else return redirect("/");
    }
    public function adminCategories(){
        if (UserController::isAdmin()) return view("admin.categories", [
            "categories" => CategoriesController::getCategories(),

            "pageTitle" => "Categories",
        ]);
        else return redirect("/");
    }
    public function adminProducts(){
        if (UserController::isAdmin()) return view("admin.products", [
            "pageTitle" => "Products",

            "categories" => CategoriesController::getCategories(),
            "products" => ProductsController::getProductsWithImages(),
        ]);
        else return redirect("/");
    }
}
