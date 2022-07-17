<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ExpertProfile extends Model
{
  use HasFactory;
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */

  protected $fillable = [
    'user_id',
    'name',
    'description',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [];

  function user()
  {
    return $this->belongsTo(User::class);
  }

  function skills()
  {
    return $this->hasMany(ExpertSkill::class);
  }

  function project_references()
  {
    return $this->hasManyThrough(ProjectReference::class, ExpertProjectReference::class);
  }

  function award_certifications()
  {
    return $this->hasManyThrough(AwardCertification::class, ExpertAwardCertification::class);
  }
}
