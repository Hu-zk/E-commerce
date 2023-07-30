<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class RegisterController extends Controller
{
    function add_user(Request $req)
    {
        try {
            $user = User::create([
                'firstname' => $req->firstname,
                'lastname' => $req->lastname,
                'email' => $req->email,
                'password' => $req->password,
                'type' => $req->type,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "account created"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => $th
            ]);
        }
    }

    function login(Request $req)
    {
        $user = User::where("email", $req->email)->first();
        if ($user === null) {
            return response()->json([
                "status" => "fail",
                "message" => "Email not found",
            ]);
        } else if (Hash::check($req->password, $user->password)) {
            return response()->json([
                "status" => "logged in",
                'user' => $user,
            ]);
        } else {
            return response()->json([
                "status" => "fail",
                "message" => "wrong password",
            ]);
        }
    }
};
