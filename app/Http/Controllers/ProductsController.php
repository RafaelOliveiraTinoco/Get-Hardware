<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str; // To generate uuid
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\UserController;

use App\Models\Product;
use App\Models\ProductImage;

class ProductsController extends Controller
{

    public function create(Request $request){
        if(UserController::isAdmin()){
            $request->validate([
                "name" => ["required", "min:2", "max:255"],
                "description" => ["required", "min:2", "max:255"],
                "category" => ["required", "exists:categories,id"],

                "price" => ["required", "decimal:0,2"],
                "discount" => ["required", "gte:0", "lte:100"], // gte -> Greater Than or Equal, lte -> Less Than or Equal

                "thumbnail" => ["required", "image"],
                "images.*" => ["required", "image"], // .* to validade array of images
            ]);

            //
            //
            //
            // Note for uploading big files
            // Check php.ini -> post_max_size and upload_max_filesize to not have problems while uploading big files
            //
            //
            //

            // Save thumbnail
            $fileName = Str::uuid() . ".png";
            Storage::disk("local")->putFileAs("product_thumbnails", // folder to be stored from root that is in <project root>/storage/app/
                $request->thumbnail, // file
                $fileName // file name = uuid + image extention
            );

            // Create product
            $product = new Product;

            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category;

            $product->price = $request->price;
            $product->discount = $request->discount;

            $product->product_thumbnail = $fileName;

            $product->save();

            $productId = $product->id; // Get id of product after insert

            //
            //
            // Handle multiple images upload
            //
            //

            foreach($request->images as $image){
                // Generate file name
                $fileName = Str::uuid() . ".png";

                // Save image
                Storage::disk("local")->putFileAs("product_images", // folder to be stored from root that is in <project root>/storage/app/
                    $image, // file
                    $fileName); // file name = uuid + image extention

                // Save in database
                $productImage = new ProductImage;

                $productImage->product_id = $productId;
                $productImage->image = $fileName;

                $productImage->save();

            }

            return redirect("/admin/products");

        }else return redirect("/");
    }

    public function edit(Request $request, $id){
        if(!UserController::isAdmin()) return redirect("/");

        // Copy request from above and edit it lmao
        $request->validate([
            "name" => ["required", "min:2", "max:255"],
            "description" => ["required", "min:2", "max:255"],
            "category" => ["required", "exists:categories,id"],

            "price" => ["required", "decimal:0,2"],
            "discount" => ["required", "gte:0", "lte:100"], // gte -> Greater Than or Equal, lte -> Less Than or Equal

            "thumbnail" => ["image"],
            "images.*" => ["image"], // .* to validade array of images

            "imagesToDelete" => ["required", "json"],
        ]);

        $product = Product::find($id);

        // Update if product exists
        if($product){
            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category;

            $product->price = $request->price;
            $product->discount = $request->discount;

            // Save Thumbnail
            if($request->hasFile("thumbnail")){
                // Delete old thumbnail
                Storage::disk("local")->delete(["product_thumbnails/" . $product->product_thumbnail]);

                $fileName = Str::uuid() . ".png";
                Storage::disk("local")->putFileAs("product_thumbnails", // folder to be stored from root that is in <project root>/storage/app/
                    $request->thumbnail, // file
                    $fileName // file name = uuid + image extention
                );

                $product->product_thumbnail = $fileName;
            }

            // Delete product images
            $imagesToDelete = json_decode($request->imagesToDelete);
            if(count($imagesToDelete->images) > 0){
                // Select images to delete
                $productImages = ProductImage::whereIn("id", $imagesToDelete->images)->where("product_id", "=", $id)->get();
                // Delete all images
                foreach($productImages as $productImage){
                    Storage::disk("local")->delete(["product_images/" . $productImage->image]);
                }
                // Delete from database
                $productImages = ProductImage::whereIn("id", $imagesToDelete->images)->where("product_id", "=", $id)->delete();
            }
            // Create new images
            if($request->hasFile("images")){
                foreach($request->images as $image){
                    // Generate file name
                    $fileName = Str::uuid() . ".png";

                    // Save image
                    Storage::disk("local")->putFileAs("product_images", // folder to be stored from root that is in <project root>/storage/app/
                        $image, // file
                        $fileName); // file name = uuid + image extention

                    // Save in database
                    $productImage = new ProductImage;

                    $productImage->product_id = $id;
                    $productImage->image = $fileName;

                    $productImage->save();
                }
            }
            $product->save();
        }
        return redirect("/admin/products");
    }

    public function delete(Request $request, $id){
        if(!UserController::isAdmin()) return redirect("/");

        $product = Product::find($id);
        if($product){
            // Get product images
            $productImages = ProductImage::where("product_id", "=", $id)->get();
            // Delete all images
            foreach($productImages as $productImage){
                Storage::disk("local")->delete(["product_images/" . $productImage->image]);
            }
            // Delete product images from database
            $productImages = ProductImage::where("product_id", "=", $id)->delete();

            // Delete product thumbnail
            Storage::disk("local")->delete(["product_thumbnails/" . $product->product_thumbnail]);

            // Delete product
            $product->delete();
        }

        return redirect("admin/products");
    }

    public static function getProducts(){
        return Product::all();
    }

    public static function getProductsWithImages(){
        $result = Product::leftJoin("products_images", "products.id", "=", "products_images.product_id")->select("products.id", "products.name", "products.description", "products.product_thumbnail", "products.category_id", "products.price", "products.discount", "products_images.image", "products_images.id as image_id")->orderBy("id")->get();

        $productsWithImages = [];

        $previousProduct = null; // this will save which product is currently beeing created
        $product = null; // this is the product that will be created
        foreach ($result as $row){
            if($row->id != $previousProduct){ // if current product != lastProduct create new object
                if ($product != null) array_push($productsWithImages, $product); // save previous created product to array
                $previousProduct = $row->id; // Update that new product will now be created

                $imagesArray = [];

                // create product
                $product = new class{};
                $product->id = $row->id;
                $product->name = $row->name;
                $product->description = $row->description;
                $product->category_id = $row->category_id;
                $product->product_thumbnail = $row->product_thumbnail;
                $product->price = $row->price;
                $product->discount = $row->discount;
                $product->images = [];

                $image = new class{};
                $image->id = $row->image_id;
                $image->image = $row->image;
                array_push($product->images, $image);

            }else{
                $image = new class{};
                $image->id = $row->image_id;
                $image->image = $row->image;
                array_push($product->images, $image); // if it's the same product only append the image
            }
        }
        array_push($productsWithImages, $product); // save last product

        return $productsWithImages;
    }
}
