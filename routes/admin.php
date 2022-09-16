<?php 

use App\Http\Controllers\admin\JobsController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\DashboardController;

Route::get('error', [LoginController::class, 'error'])->name('login');


Route::group([
    'prefix' => 'auth',
], function() {
    Route::post('login', [LoginController::class, 'login']);
});


Route::group([ 
    'middleware' => ['auth:admin-api'], 
], function() { 
    Route::get('dashboard', [DashboardController::class, 'index']); 
    Route::get('users', [UserController::class, 'index']); 
    Route::get('users/all', [UserController::class, 'all']); 
    Route::get('user/{id}', [UserController::class, 'show']); 
    Route::get('users/search/{search_term}', [UserController::class, 'search']); 
    Route::get('jobs', [JobsController::class, 'index']); 
    Route::get('jobs/all', [JobsController::class, 'all']); 
    Route::get('job/{id}', [JobsController::class, 'show']); 
    Route::post('job/invite', [JobsController::class, 'sendInvite']); 
    Route::get('jobs/search/{search_term}', [JobsController::class, 'search']); 
    Route::post('change-password', [LoginController::class, 'changePassword']); 
}); 