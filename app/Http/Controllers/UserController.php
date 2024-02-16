<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function index( Request $request ){
    $user = User::where("email",$request->email)->first();
     if (!$user || !Hash::check($request->password, $user->password)) {
        return response([
            'message' => ['These credentials do not match our records.']
        ], 404);

    // responce ->It takes two parameters: an array representing the content of the response and an HTTP status code.
     }

     $token = $user->createToken('my-app-token')->plainTextToken;
     
     $response = [
         'user' => $user,
         'token' => $token,
     ];
 
     return response($response, 200);
   }
}
