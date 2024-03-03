<?php

use App\Http\Controllers\VelzonRoutesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    
    Route::controller(App\Http\Controllers\HomeController::class)->group(function () {
        Route::get('/', 'dashboard');
    });

    Route::prefix('directory')->group(function(){
        Route::resource('/certifications', App\Http\Controllers\Directory\CertificationController::class);
        Route::resource('/schools', App\Http\Controllers\Directory\SchoolController::class);
        Route::resource('/courses', App\Http\Controllers\Directory\CourseController::class);
    }); 

    Route::prefix('lists')->group(function(){
        Route::resource('/agencies', App\Http\Controllers\Lists\AgencyController::class);
        Route::resource('/locations', App\Http\Controllers\Lists\LocationController::class);
        Route::resource('/dropdowns', App\Http\Controllers\Lists\DropdownController::class);
    }); 

    Route::middleware(['nothing'])->group(function () {
        Route::get('/utilities/{type}', [App\Http\Controllers\Utility\IndexController::class, 'index']);
        Route::prefix('utility')->group(function(){
            Route::prefix('logs')->group(function(){
                Route::controller(App\Http\Controllers\Utility\LogController::class)->group(function () {
                    Route::get('/authentications','authentication');
                    Route::get('/activities','activity');
                });
            });
            Route::resource('/config', App\Http\Controllers\Utility\ConfigController::class);
            Route::resource('/users', App\Http\Controllers\Utility\UserController::class);
            Route::resource('/roles', App\Http\Controllers\Utility\RoleController::class);
            Route::resource('/backups', App\Http\Controllers\Utility\BackupController::class);
            
            Route::prefix('menus')->group(function(){
                Route::controller(App\Http\Controllers\Utility\MenuController::class)->group(function () {
                    Route::get('/','index');
                    Route::post('/','store');
                });
            });
        });
    });
});
