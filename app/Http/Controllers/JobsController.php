<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ExpertProfile;
use App\Models\JobApplication;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::latest()->paginate(5);
        return response()->json(['jobs' => $jobs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        return response(['job' => $job]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }

    public function getInvitations($email)
    {
        $user = User::where('email', $email)->first();
        $jobs = $user->jobs_invited;
        return response(['jobs' => $jobs]);
    }

    public function apply(Request $request)
    {
        $validated = $request->validate([
            'job_id' => 'required|integer',
            'user' => 'required|string|email',
        ]);

        $job_id = $request->job_id;
        $expert_profile_id = $request->expert_profile_id;
        $user = $request->user;
        $description = $request->description;


        $user = User::where('email', $request->user)->first();
        $find = JobApplication::where(['user_id' => $user->id, 'job_id' => $job_id])->get();
        

        if (count($find) < 1) {

            $job = JobApplication::create([
                'job_id' => $job_id,
                'user_id' => $user->id,
                'description' => $description,
                'expert_profile_id' => $expert_profile_id,
                'created_at' => now()
            ]);
    
            if ($job) {
                $response['status'] = 'success';
                $response['message'] = 'You have successfully applied for this job';
                $response['job'] = $job;
                return response($response, 200);
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'You have already applied for this job';
            return response($response, 400);
        }
        
    }

    public function getAllApplied($email)
    {
        $user = User::where('email', $email)->first();
        $jobs = $user->jobs_applied;

        foreach ($jobs as $job) {
            $application = JobApplication::where('user_id', $job->pivot->user_id)
                                           ->where('job_id', $job->pivot->job_id)->first();
                                           
            $job->application_id = $application->id;
            $job->status = $application->status;
        }

        return response(['jobs' => $jobs]);
    }

    public function getApplied($id)
    {
        $query = JobApplication::find($id);
        $user = User::find($query->user_id);
        $profile = ExpertProfile::find($query->expert_profile_id);
        $job = Job::find($query->job_id);

        return response(['job' => $job, 'profile' => $profile, 'status' => $query->status]);
    }


    public function interested(Request $request)
    {
        $validated = $request->validate([
            'job_id' => 'required|integer',
            'user' => 'required|string|email',
        ]);

        $job_id = $request->job_id;
        $user = $request->user;

        $user = User::where('email', $request->user)->first();

        $find = DB::table('job_interested')->where(['user_id' => $user->id, 'job_id' => $job_id])->get();
        

        if (count($find) < 1) {
            $job = DB::table('job_interested')->insert([
                'job_id' => $job_id,
                'user_id' => $user->id,
                'created_at' => now()
            ]);
    
            if ($job) {
                $response['status'] = 'success';
                $response['message'] = 'Job added to interest list';
                return response($response, 200);
            }
        } else {
            $response['status'] = 'success';
            $response['message'] = 'Job already exist in interest list';
            return response($response, 200);
        }
        
    }

    public function getInterested($email)
    {
        $user = User::where('email', $email)->first();
        $jobs = $user->jobs;
        return response(['jobs' => $jobs]);
    }


    public function search(Request $request){
        $jobs = Job::where([
            ['title', '!=', null],
            [function ($query) use ($request) {
                if (($term = $request->search_term)) {
                    $query->orWhere('title', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])->paginate(5);
        
        return response(['jobs' => $jobs]);
    }

    public function filter(Request $request)
    {
        $jobs = Job::query();

        $term = $request->search_term;
        $country = $request->country;
        $functional_skills = $request->functional_skills;
        $industry_expertise = $request->industry_expertise;
        $experience = $request->experience;
        $availability = $request->availability;

        if ($term) {
            $jobs->where('title','LIKE','%'.$term.'%')
                    ->orWhere('description','LIKE','%'.$term.'%');
        }

        if ($country) {
            $jobs->where('country','LIKE','%'.$country.'%');
        }

        if ($functional_skills) {
            $jobs->where('functional_skills', 'LIKE','%'. $functional_skills .'%');
        }

        if ($industry_expertise) {
            $jobs->whereIn('industry', $industry_expertise);
        }

        if ($experience) {
            $jobs->where('experience', 'LIKE','%'. $experience .'%');
        }

        if ($availability) {
            $jobs->where('availability', 'LIKE','%'. $availability .'%');
        }


        $jobs = $jobs->paginate(5);
        return response(['jobs' => $jobs]);

    }
}
