<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    function getProducts()
    {
        $product = Product::all();
        if ($product != null) {
            return response()->json([
                "status" => "success",
                "product" => $product,
                "message" => "products displayed"
            ]);
        } else {
            return response()->json([
                "status" => "failed",
                "message" => "No products"
            ]);
        }
    }



    function addProduct(Request $req)
    {
        try {
            $product = Product::create([
                'name' => $req->name,
                'price' => $req->price,
                'category' => $req->category,
                'description' => $req->description,
                // 'image_url' => $req->image_url->store('product_images', 'public'),
                'image_url' => $req->image_url,
            ]);

            return response()->json([

                "status" => "success",
                "message" => "product added"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => $th
            ]);
        }
    }

    function updateProduct(Request $req)
    {
        $product = Product::find($req->id);
        if ($product != null) {
            $product->name = $req->name;
            $product->price = $req->price;
            $product->category = $req->category;
            $product->description = $req->description;
            $product->image_url = $req->image_url;
            $product->save();
            return response()->json([
                "status" => "success",
                "message" => "product edited"
            ]);
        } else {
            return response()->json([
                "status" => "failed",
                "message" => "dont exist"
            ]);
        }
    }

    function deleteProduct(Request $req)
    {
        $product = Product::find($req->id);
        if ($product->id != null) {
            $product->delete();
            return response()->json([
                "status" => "success",
                "message" => "product deleted"
            ]);
        } else {
            return response()->json([
                "status" => "failed",
                "message" => "product deleted"
            ]);
        }
    }
}
