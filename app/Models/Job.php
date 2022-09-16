<?php

namespace App\Models;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $fillables = [
        'title',
        'description',
        'industry',
        'availability',
        'pay_rate',
        'experience',
        'candidates_required',
        'location',
        'country',
        'industry_experience',
        'functional_skills',
        'ends_on'
    ];

    
    /**
     * The users that belong to the Job
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'job_interested');
    }


    /**
     * The users that belong to the Job
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users_applied()
    {
        return $this->belongsToMany(User::class, 'job_applications')
                ->withPivot('status')
                ->withPivot('created_at');
    }


    /**
     * The users that belong to the Job
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users_invited()
    {
        return $this->belongsToMany(User::class, 'job_invitations');
    }

}
