<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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
  Route::get('work-experience', [UserController::class, 'getWorkExperiences']);
  Route::get('project-reference', [UserController::class, 'getProjectReferences']);
  Route::get('skill', [UserController::class, 'getSkills']);
  Route::get('certification', [UserController::class, 'getCertifications']);
  Route::get('interest', [UserController::class, 'getInterests']);

  Route::group([
    'prefix' => 'update'
  ], function () {
    Route::post('personal-information', [UserController::class, 'updatePersonalInfo']);
    Route::post('short-bio', [UserController::class, 'updateShortBio']);
    Route::post('work-experience', [UserController::class, 'updateWorkExperience']);
    Route::post('project-reference', [UserController::class, 'updateProjectReferences']);
    Route::post('skill', [UserController::class, 'updateSkills']);
    Route::post('certification', [UserController::class, 'updateCertifications']);
    Route::post('interest', [UserController::class, 'updateInterests']);

  });
});
