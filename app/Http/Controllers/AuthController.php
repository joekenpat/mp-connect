<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  public function signUp(Request $request)
  {
    $data = $request->validate([
      'email' => 'required|email|unique:users',
      'password' => 'required|alpha_num'
    ]);

    $data['password'] = bcrypt($request->password);

    $user = User::create($data);
    $token = $user->createToken(config('app.name'))->accessToken;

    return response(['user' => $user, 'token' => $token]);
  }

  public function signIn(Request $request)
  {
    $data = $request->validate([
      'email' => 'email|required|exists:users',
      'password' => 'required|alpha_num'
    ]);

    if (!auth()->attempt($data)) {
      return response(['error_message' => 'Incorrect Details.
          Please try again']);
    }

    $token = auth()->user()->createToken(config('app.name'))->accessToken;

    return response(['user' => auth()->user(), 'token' => $token]);
  }
}
