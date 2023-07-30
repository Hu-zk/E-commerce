<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function addProduct(Request $req)
    {
        try {
            $product = Product::create([
                'name' => $req->name,
                'price' => $req->price,
                'category' => $req->category,
                'description' => $req->description,
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
            return json_encode(["status" => "success"]);
        } else {
            return json_encode(["status" => "failed"]);
        }
    }
}
