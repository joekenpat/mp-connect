<?php

namespace App\Http\Controllers\admin;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::limit(5)->orderBy('created_at', 'DESC')->get();
        $users_count = User::count();
        $jobs_count = Job::count();

        return response()->json(['users' => $users, 'user_count' => $users_count, 'jobs_count' => $jobs_count], 200);
    }
}