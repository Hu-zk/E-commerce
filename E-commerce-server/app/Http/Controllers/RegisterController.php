<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class RegisterController extends Controller
{
    function add_user()
    {
        echo "sign up";

        try {
            $user = User::create([
                'firstname' => "hsen",
                'lastname' => "zreik",
                'email' => "hse@gmail.com",
                'password' => "husain3d",
                'type' => "user",
            ]);

            return response()->json([
                "message" => "success"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "failed",
                "throwable" => $th
            ]);
        }
    }
};
