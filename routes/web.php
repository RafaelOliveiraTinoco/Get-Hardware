<?php

use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;

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

Route::get('/', [PagesController::class, "index"]);

Route::post("/register", [UserController::class, "register"]);
Route::post("/login", [UserController::class, "login"]);
Route::get("/logout", [UserController::class, "logout"]);

// Admin Routes
Route::get("/admin", [PagesController::class, "adminIndex"]);

Route::get("/admin/categories", [PagesController::class, "adminCategories"]);
Route::post("/admin/categories/create", [CategoriesController::class, "create"]);
Route::get("/admin/categories/delete/{id}", [CategoriesController::class, "delete"]);
Route::post("/admin/categories/edit/{id}", [CategoriesController::class, "edit"]);

Route::fallback(function () {
    return redirect("/");
});
