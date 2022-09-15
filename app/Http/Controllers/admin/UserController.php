<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(10);
        return response()->json(['users' => $users], 200);
    }

    public function show($id)
    {
        $user = User::find($id);
        $user->work_experiences = $user->work_experiences;
        $user->expert_profiles = $user->expert_profiles;
        foreach ($user->expert_profiles as $profile) {
            $profile->skills = $profile->skills;
        }
        return response()->json(['user' => $user], 200);
    }
}
