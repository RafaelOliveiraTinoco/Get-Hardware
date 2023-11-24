<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Common user routes
Route::get('/', [PagesController::class, "index"]);

Route::post("/register", [UserController::class, "register"]);
Route::post("/login", [UserController::class, "login"]);
Route::get("/logout", [UserController::class, "logout"]);

// Admin Routes
Route::get("/admin", [PagesController::class, "adminIndex"]);

Route::get("/admin/categories", [PagesController::class, "adminCategories"]);
Route::post("/admin/categories/create", [CategoriesController::class, "create"]);
Route::post("/admin/categories/edit/{id}", [CategoriesController::class, "edit"]);
Route::get("/admin/categories/delete/{id}", [CategoriesController::class, "delete"]);

Route::get("/admin/products", [PagesController::class, "adminProducts"]);
Route::post("/admin/products/create", [ProductsController::class, "create"]);
Route::post("/admin/products/edit/{id}", [ProductsController::class, "edit"]);
Route::get("/admin/products/delete/{id}", [ProductsController::class, "delete"]);

Route::fallback(function () {
    return redirect("/");
});
