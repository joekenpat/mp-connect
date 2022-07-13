<?php

namespace App\Models;

use App\Models\User\AwardCertification;
use App\Models\User\ProjectReference;
use App\Models\User\Skill;
use App\Models\User\WorkExperience;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

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
    'fixed_phone',
    'countries_of_work_experience',
    'years_of_work_experience',
    'hands_on_technology',
    'languages',
    'utm_medium',
    'name_of_professional',
    'topic_of_interests',
    'areas_of_contribution',
    'short_bio',
    'date_of_birth',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'hands_on_technology' => 'array',
    'topic_of_interests' => 'array',
    'areas_of_contribution' => 'array',
    'languages' => 'array',
    'date_of_birth' => 'datetime'
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
}
