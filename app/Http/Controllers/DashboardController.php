<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() 
    { 
        $jobs = Job::inRandomOrder()->paginate(5); 
        foreach($jobs as $job) { 
            $job->interested = $job->users->where('id', auth()->id())->first() ? true : false; 
            // dump($job->interested);
        } 
        return response()->json(['jobs' => $jobs], 200); 
    } 

    public function counts($email)
    {
        
        $user = User::where('email', $email)->first();

        $applied_jobs = $user->jobs_applied->count();
        $invited_jobs = $user->jobs_invited->count();
        $interested_jobs = $user->jobs->count();


        return response()->json(['history' => $applied_jobs, 'invites' => $invited_jobs, 'interested' => $interested_jobs]);
    }

    
}
