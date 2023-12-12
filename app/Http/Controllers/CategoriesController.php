<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Http\Controllers\UserController;

class CategoriesController extends Controller
{
    public function create(Request $request){
        if(UserController::isAdmin()){
            $request->validate([
                "name" => ["required", "min:2", "unique:categories,name"],
            ]);

            // Create category
            $category = new Category;
            $category->name = $request->name;
            $category->save();

            return redirect("/admin/categories");

        }else return redirect("/");
    }

    public function delete(Request $request, $id){
        if(UserController::isAdmin()){

            $category = Category::find($id);

            // If exists delete
            if($category) $category->delete();

            return redirect("/admin/categories");
        }else return redirect("/");
    }

    public function edit(Request $request, $id){
        if(UserController::isAdmin()){
            $request->validate([
                "name" => ["required", "min:2", "unique:categories,name"],
            ]);

            // Edit category
            $category = Category::find($id);
            // If exists update
            if($category){
                $category->name = $request->name;
                $category->save();
            }

            return redirect("/admin/categories");


        }else return redirect("");
    }

    public static function getCategories(){
        return Category::all();
    }

    public static function getCategoriesWithProducts(){ // Returns all categories that have products
        return DB::table("categories")
            ->join("products", "categories.id", "=", "products.category_id") // Inner join, only returns cageroies that have a product associated with
            ->select("categories.*") // From the query select only the categories data
            ->distinct() // Unique id
            ->get();
    }
}
