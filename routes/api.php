<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\requstes\ProjectRequest;
use App\Http\requests\RegisterRequest;
use App\Http\requests\LoginRequest;
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

/*Route::post('project',[ProjectController::class, 'register']);
Route::post('/project/login',[ProjectController::class, 'login']);
*/
use App\Http\Controllers\AuthController;
Route::post('register',[AuthController::class, 'register']);
//Route::middleware('auth:api')->post('login', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'login']);