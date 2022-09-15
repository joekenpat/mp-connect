<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller 
{ 
    public function login(Request $request) 
    { 
        $loginData = $request->validate([ 
            'email' => 'required|string|email|exists:admins', 
            'password' => 'required|string' 
        ]); 


        if (auth()->guard('admin')->attempt($loginData)) { 
            $accessToken = auth()->guard('admin')->user()->createToken('authToken')->accessToken; 
            return response()->json(['user' => auth()->guard('admin')->user(), 'token' => $accessToken], 200); 
        } else { 
            $passwordError = [
                'password' => ['Password is incorrect']
            ];
            return response()->json(['errors' => $passwordError], 422);
        } 
    } 




    public function error()
    {
        return response()->json(['message' => 'Not authenticated'], 401);
    }



} 