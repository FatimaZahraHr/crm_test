<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\EmployeController;
use App\Http\Controllers\Api\AdminController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('App\Http\Controllers\Api')->group(function () { 
    Route::post('login', 'AuthController@login');
    Route::get('/profil/{email}','AuthController@profil');
    Route::put('valideprofil/{id}', 'EmployeController@update');
    Route::put('employee/{id}/cancel', 'EmployeController@cancel');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resources([
        'company'     => CompanyController::class,
        'employee'    => EmployeController::class,
        'admin'       => AdminController::class,
    ]);
    Route::namespace('App\Http\Controllers\Api')->group(function () { 
        Route::get('/searchcompany/{q?}', 'CompanyController@search');
        Route::get('/searchemployee/{q?}', 'EmployeController@search');

        Route::get('/logs', 'LogsController@getlogs');
        Route::get('/company/:id', 'CompanyController@getcomapny');
        Route::get('/colleagues/{id}', 'EmployeController@colleagues');
        Route::get('/count', 'AdminController@count');
    });

});



