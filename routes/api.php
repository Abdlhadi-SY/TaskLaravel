<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('showAllTasks', [TaskController::class,'showAllTasks']);
    Route::get('showTask/{task}', [TaskController::class,'showTask']);
    Route::post('addTask', [TaskController::class,'addTask']);
    Route::post('updateTaskStatus/{task}', [TaskController::class,'updateTaskStatus']);
    Route::post('updateTaskDetails/{task}', [TaskController::class,'updateTaskDetails']);
});
