<?php

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

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('departments', App\Http\Controllers\API\DepartmentController::class)
        ->only('index', 'update', 'destroy');

    Route::apiResource('projects', App\Http\Controllers\API\ProjectController::class);
    Route::patch('projects/status/{project}', [App\Http\Controllers\API\ProjectController::class, 'status'])
        ->name('projects.status');
});
