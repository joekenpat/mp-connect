<?php

namespace App\Http\Controllers\admin;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class JobsController extends Controller
{

    public function all()
    {
        $jobs = Job::all();
        return response()->json(['jobs' => $jobs], 200);
    }

    public function index()
    {
        $jobs = Job::orderBy('created_at', 'DESC')->paginate(10);
        return response()->json(['jobs' => $jobs], 200);
    }

    function show($id)
    {
        $job = Job::find($id);
        $job->candidates = $job->users_applied;
        foreach ($job->users_applied as $candidate) {
            $candidate->status = $candidate->pivot->status;
            $candidate->applied_at = $candidate->pivot->created_at;
        }
        return response()->json(['job' => $job], 200);
    }

    public function sendInvite(Request $request)
    {
        $job_id = $request->job_id;
        $user_id = $request->user_id;

        $user = User::find($user_id);
        $find = DB::table('job_invitations')->where(['user_id' => $user_id, 'job_id' => $job_id])->get();
        

        if (count($find) < 1) {
            $job = DB::table('job_invitations')->insert([
                'job_id' => $job_id,
                'user_id' => $user_id,
                'created_at' => now()
            ]);
    
            if ($job) {
                $response['status'] = 'success';
                $response['message'] = 'A Job invitation has been sent to ' . $user->first_name . ' ' . $user->last_name;
                return response($response, 200);
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'You have already sent an invitation to this user for this job';
            return response($response, 400);
        }
    }


    public function search($search_term){
        $jobs = Job::query();
        $term = $search_term;
        
        if ($term) {
            $jobs->where('title','LIKE','%'.$term.'%')
                    ->orWhere('industry','LIKE','%'.$term.'%')
                    ->orWhere('description','LIKE','%'.$term.'%')
                    ->orWhere('country','LIKE','%'.$term.'%')
                    ->orWhere('availability', 'LIKE','%'. $term .'%');
        }
                
        $jobs = $jobs->paginate(10);
        return response(['jobs' => $jobs], 200);
    }

}
