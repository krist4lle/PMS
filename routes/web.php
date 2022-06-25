<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', App\Http\Controllers\HomeController::class)->name('index');

    Route::get('/employees', [App\Http\Controllers\Employee\IndexController::class, 'index'])
        ->name('employees.index');
    Route::get('/profile/{user}', [App\Http\Controllers\Employee\IndexController::class, 'profile'])
        ->name('profile.index');

    Route::get('/me', [App\Http\Controllers\Me\IndexController::class, 'index'])->name('me.index');
    Route::patch('/me', [App\Http\Controllers\Me\IndexController::class, 'update'])->name('me.update');
    Route::post('/change-password', [App\Http\Controllers\Me\IndexController::class, 'changePassword'])
        ->name('me.update.password');

    Route::resource('departments', App\Http\Controllers\DepartmentController::class)
        ->only('index', 'edit', 'update', 'destroy');

    Route::resource('positions', App\Http\Controllers\PositionController::class)
        ->except('show');

    Route::resource('users', App\Http\Controllers\UserController::class);

    Route::resource('projects', App\Http\Controllers\ProjectController::class);
});
