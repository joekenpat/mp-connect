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

    public function all()
    {
        $users = User::all();
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

    public function search($search_term){
        $users = User::query();
        $term = $search_term;
        
        if ($term) {
            $users->where('first_name','LIKE','%'.$term.'%')
                    ->orWhere('last_name','LIKE','%'.$term.'%')
                    ->orWhere('email','LIKE','%'.$term.'%')
                    ->orWhere('years_of_work_experience','LIKE','%'.$term.'%')
                    ->orWhere('nationality', 'LIKE','%'. $term .'%');
        }
                
        $users = $users->paginate(10);
        return response(['users' => $users], 200);
    }
}
