<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use App\Models\ProductImage;

class MediaController extends Controller
{
    public function productThumbnail(Request $request, $productThumbnail){
        // conditions
        // validations
        $result = Product::where("product_thumbnail", $productThumbnail)->first(); // Check if there is a product image with given name
        if ($result){
            $file = Storage::get("product_thumbnails/" . $productThumbnail);
            return $file;
        }
        else abort(404);
    }

    public function productImage(Request $request, $productImage){
        // conditions
        // validations
        $result = ProductImage::where("image", $productImage)->first();
        if ($result){
            $file = Storage::get("product_images/" . $productImage);
            return $file;
        }
        else abort(404);
    }
}
