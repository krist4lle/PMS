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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/get-api-data', function () {
    return response()->json([
        'status' => 'OK',
        'game' => 'Tarkov',
        'version' => 2,
    ]);
});

Route::post('/set-api-data', function () {
    $data = request()->json()->all();
    return response()->json([
        'status' => 'saved',
        'game' => 'Tarkov huynya',
        'data' => $data,
    ]);
});
