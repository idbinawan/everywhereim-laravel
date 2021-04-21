<?php

use App\Http\Controllers\UserColorController;
use App\Http\Controllers\ColorController;
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

Route::get('/users', [UserColorController::class, 'getUsers']);
Route::get('/user/{id}', [UserColorController::class, 'getUser']);
Route::get('/colors/{user_id}', [ColorController::class, 'show']);
Route::get('/colors', [ColorController::class, 'index']);
Route::post('/colors', [UserColorController::class, 'store']);
Route::put('/colors/{id}', [UserColorController::class, 'update']);
Route::delete('/colors/{id}', [UserColorController::class, 'delete']);
Route::get('/shuffle-colors/{user_id}', [UserColorController::class, 'shuffleColors']);
Route::delete('/user/{id}', [UserColorController::class, 'deleteUserColors']);
Route::get('/create-user', [UserColorController::class, 'createUserColor']);
