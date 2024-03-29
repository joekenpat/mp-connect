<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProjectReference extends Model
{
    use HasFactory;

    /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'user_id',
    'name_of_client',
    'industry',
    'document_file',
    'functional_skills',
    'description',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = ['pivot'];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'functional_skills' => 'array',
  ];

  function getDocumentFileAttribute($value)
  {
    return $value ? asset('storage/'.$value) : null;
  }
}
