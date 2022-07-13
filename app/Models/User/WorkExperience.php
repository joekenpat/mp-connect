<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
  use HasFactory;
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'user_id',
    'job_title',
    'employer_name',
    'industry',
    'hands_on_technology',
    'start_month',
    'start_year',
    'end_month',
    'end_year',
    'is_current_role',
    'description',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'created_at', 'updated_at'
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'hands_on_technology' => 'array',
    'is_current_role' => 'boolean',
  ];

  function user()
  {
    return $this->belongsTo(User::class);
  }

  function setIsCurrentRoleAttribute($value)
  {
    $this->attributes['is_current_role'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
  }
}
