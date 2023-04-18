<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Models\CompletedJobs;
use App\Models\Customer;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ViewtaskController;

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

/** ---------Register and Login ----------- */
Route::controller(RegisterController::class)->group(function()
{
    Route::get('register', 'register');
    Route::get('login', 'login');
    Route::get('users', 'login')->name('index');

});

/** -----------Users --------------------- */
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/users',[RegisterController::class,'index'])->name('index');
});

Route::middleware('auth:sanctum')->controller(RegisterController::class)->group(function() {
    Route::get('/users','index')->name('index');
});

Route::middleware(['api'])->group(function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me')->middleware('log.route');
    Route::post('register', 'RegistrationController@register');
    Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
    Route::post('password/email', 'ForgotPasswordController@forgot');
    Route::post('password/reset', 'ForgotPasswordController@reset');
    //FR4
    Route::post('/completedJob/store',[CompletedJobsController::class,'addCompletedJob']);
    Route::get('/completedJob/delete/{id}',[CompletedJobsController::class,'deleteCompletedJob']);
    Route::post('/completedJob/update/{id}',[CompletedJobsController::class,'update']);
    //FR2
    Route::get('/all',[CustomerController::class,'customers']);
    Route::post('/add-customer',[CustomerController::class,'addCustomer']);
    Route::get('/customer/delete/{id}',[CustomerController::class,'delete']);
    Route::post('/update-customer/{id}',[CustomerController::class,'update']);
    //FR 3 
    Route::post('/add-service',[ServiceController::class, 'addService']);
    Route::get('/delete/{id}',[ServiceController::class,'delete']);
    Route::post('/update/{id}',[ServiceController::class,'update']);
});
Route::get('/view-task',[viewtaskController::class,'viewTask']);