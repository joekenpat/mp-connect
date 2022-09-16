<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller 
{ 
    public function login(Request $request) 
    { 
        $loginData = $request->validate([ 
            'email' => 'required|string|email|exists:admins,email', 
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



    public function changePassword(Request $request)
    {
        $data = $request->validate([ 
            'email' => 'required|email|string|exists:admins,email',
            'current_password' => 'required|string|current_password', 
            'new_password' => 'required|string|min:8|different:current_password|confirmed'
        ]);
        

        $admin = Admin::where('email', $request->email)->first();
        $admin->password = Hash::make($request->new_password);

        if ($admin->save()) {
            auth()->user()->password = $admin->password;
            return response()->json(['message' => 'Password has been updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Sorry, an error occured'], 400);
        }

    }



    public function error()
    {
        return response()->json(['message' => 'Not authenticated'], 401);
    }



} 