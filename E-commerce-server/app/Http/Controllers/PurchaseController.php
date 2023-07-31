<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class PurchaseController extends Controller
{
    function addToCart(Request $req)
    {
        try {
            $product = Cart::where('user_id', $req->user_id)->where('product_id', $req->product_id)->first();
            if ($product == null) {
                $slot = Cart::create([
                    'user_id' => $req->user_id,
                    'product_id' => $req->product_id,
                    'quantity' => 1,
                ]);
            } else {
                $product->quantity = $product->quantity + 1;
                $product->save();
            }

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
}
