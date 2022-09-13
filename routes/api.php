<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UtilitiesController;
use App\Http\Controllers\ExpertProfileController;
use App\Http\Controllers\WorkExperienceController;
use App\Http\Controllers\ProjectReferenceController;
use App\Http\Controllers\AwardCertificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
  'prefix' => 'auth'
], function () {
  Route::post('/sign-in', [AuthController::class, 'signIn']);
  Route::post('/sign-up', [AuthController::class, 'signUp']);
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::post('/refresh', [AuthController::class, 'refresh']);
});

Route::group([
  'prefix' => 'utilities',
], function() {
  Route::get('countries', [UtilitiesController::class, 'country']);
  Route::get('industries', [UtilitiesController::class, 'industry']);
  Route::get('functional_skills', [UtilitiesController::class, 'functional_skills']);
});


Route::group([
  'middleware' => ['auth:api'],
  'prefix' => 'profile'
], function () {
  Route::get('', [UserController::class, 'getProfileInformation']);
  Route::get('work-experience', [WorkExperienceController::class, 'getWorkExperiences']);
  Route::get('project-reference', [ProjectReferenceController::class, 'getProjectReferences']);
  Route::get('skill', [SkillController::class, 'getSkills']);
  Route::get('certification', [AwardCertificationController::class, 'getCertifications']);
  Route::get('interest', [UserController::class, 'getInterests']);

  
  Route::group([ 
    'prefix' => 'update'
  ], function () {
    Route::post('personal-information', [UserController::class, 'updatePersonalInfo']);
    Route::post('short-bio', [UserController::class, 'updateShortBio']);
    Route::post('work-status', [UserController::class, 'updateJobSearchPreference']);
    Route::post('work-experience', [WorkExperienceController::class, 'updateWorkExperience']);
    Route::post('project-reference', [ProjectReferenceController::class, 'updateProjectReferences']);
    Route::post('skill', [SkillController::class, 'updateSkills']);
    Route::post('certification', [AwardCertificationController::class, 'updateCertifications']);
    Route::post('interest', [UserController::class, 'updateInterests']);
  });
});


Route::group([
  'middleware' => ['auth:api'],
  'prefix' => 'expert-profile'
], function () {
  Route::get('', [ExpertProfileController::class, 'getExpertProfiles']);
  Route::group(['prefix' => '/{expert_profile_id}', 'where' => ['expert_profile_id' => '[0-9]+']], function () {
    Route::get('', [ExpertProfileController::class, 'getExpertProfile']);
    Route::get('project-reference', [ProjectReferenceController::class, 'getExpertProjectReferences']);
    Route::get('skill', [SkillController::class, 'getExpertSkill']);
    Route::get('certification', [AwardCertificationController::class, 'getExpertCertification']);
  });
  

  Route::group([
    'prefix' => 'update'
  ], function () {
    Route::post('personal-information', [ExpertProfileController::class, 'updateExpertProfile']);
    Route::post('project-reference', [ProjectReferenceController::class, 'updateExpertProjectReferences']);
    Route::post('skill', [SkillController::class, 'updateExpertSkills']);
    Route::post('certification', [AwardCertificationController::class, 'updateExpertCertifications']);
  });
});


Route::group([
  'middleware' => ['auth:api'],
  'prefix' => 'dashboard',
], function() {
  Route::get('', [DashboardController::class, 'index']);
  Route::get('counts/{email}', [DashboardController::class, 'counts']);
});


Route::group([ 
  'middleware' => ['auth:api'], 
  'prefix' => 'jobs', 
], function() { 
  Route::get('', [JobsController::class, 'index']); 
  Route::get('details/{job}', [JobsController::class, 'show']); 
  Route::get('interested/{email}', [JobsController::class, 'getInterested']); 
  Route::get('invitations/{email}', [JobsController::class, 'getInvitations']); 
  Route::get('all-applied/{email}', [JobsController::class, 'getAllApplied']); 
  Route::get('applied/{id}', [JobsController::class, 'getApplied']); 
  Route::post('apply', [JobsController::class, 'apply']); 
  Route::post('interested', [JobsController::class, 'interested']); 
});


Route::group([
  'middleware' => ['auth:api'],
  'prefix' => 'search',
], function() {
  Route::post('', [JobsController::class, 'search']);
  Route::post('filter', [JobsController::class, 'filter']);
});