<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthEmployerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::get('/jobs', [JobController::class, 'index']);
// Route::post('/jobs', [JobController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
	// return $request->user();
	Route::post('/logout', [AuthController::class, 'logout']);
});

Route::resource('jobs', JobController::class);
Route::get('/jobs/search/{name}', [JobController::class, 'search']);

Route::post('/register/employee', [AuthController::class, 'register']);
Route::post('/login/employee', [AuthController::class, 'login']);
