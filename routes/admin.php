<?php 

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
    Route::get('user/{id}', [UserController::class, 'show']); 
}); 