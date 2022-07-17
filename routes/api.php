<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AwardCertificationController;
use App\Http\Controllers\ExpertProfileController;
use App\Http\Controllers\ProjectReferenceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkExperienceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::post('certification', [AwardCertificationController::class, 'updateCertifications']);
  });
});
