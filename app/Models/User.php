<?php

namespace App\Models;

use App\Models\Job;
use App\Models\Skill;
use App\Models\WorkExperience;
use App\Models\ProjectReference;
use App\Models\AwardCertification;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'email',
    'password',
    'first_name',
    'last_name',
    'profile_image',
    'gender',
    'nationality',
    'current_address',
    'mobile_phone',
    'current_job_title',
    'countries_of_work_experience',
    'years_of_work_experience',
    // 'hands_on_technology',
    'languages',
    'utm_medium',
    'name_of_professional',
    'topic_of_interests',
    'areas_of_contribution',
    'short_bio',
    'date_of_birth',
    'current_job_status',
    'available_for_job_from',
    'available_for_fulltime_job_from',
    'preferred_job_location_type',
    'preferred_job_hours_per_week',
    'preferred_job_countries',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
    "hands_on_technology",
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    // 'hands_on_technology' => 'array',
    'topic_of_interests' => 'array',
    'areas_of_contribution' => 'array',
    'languages' => 'array',
    'countries_of_work_experience' => 'array',
    'date_of_birth' => 'date:Y-m-d',
    'available_for_job_from' => 'date:Y-m-d',
    'available_for_fulltime_job_from' => 'date:Y-m-d',
    'preferred_job_countries' => 'array',
  ];

  function work_experiences()
  {
    return $this->hasMany(WorkExperience::class);
  }

  function project_references()
  {
    return $this->hasMany(ProjectReference::class);
  }

  function award_certifications()
  {
    return $this->hasMany(AwardCertification::class);
  }

  function skills()
  {
    return $this->hasMany(Skill::class);
  }

  function expert_profiles()
  {
    return $this->hasMany(ExpertProfile::class);
  }
  // function getProfileImageAttribute($value)
  // {
  //   return $value ? asset('storage/' . $value) : null;
  // }

  public function jobs()
  {
    return $this->belongsToMany(Job::class, 'job_interested');
  }

  public function jobs_applied()
  {
    return $this->belongsToMany(Job::class, 'job_applications');
  }

  public function jobs_invited()
  {
    return $this->belongsToMany(Job::class, 'job_invitations');
  }
  
}
