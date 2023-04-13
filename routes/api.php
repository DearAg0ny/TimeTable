<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompletedJobsController;

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

//FR 4
Route::get('/test',[CompletedJobsController::class,'index']);
Route::post('/completedJob/store',[CompletedJobsController::class,'addCompletedJob']);
Route::get('/completedJob/delete/{id}',[CompletedJobsController::class,'deleteCompletedJob']);
Route::post('/completedJob/update/{id}',[CompletedJobsController::class,'update']);
