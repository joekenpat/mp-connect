<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;    
    protected $guard = 'admin';    
    
    protected $fillable = [
        'email', 'password',
    ];    
    
    protected $hidden = [
        'password', 'remember_token',
    ];
}
