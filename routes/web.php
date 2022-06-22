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

Route::middleware('auth')->group(function () {
    Route::get('/home', App\Http\Controllers\IndexController::class)->name('index');

    Route::get('/employees', [App\Http\Controllers\Employee\IndexController::class, 'index'])
        ->name('employees.index');
    Route::get('/profile/{user}', [App\Http\Controllers\Employee\IndexController::class, 'profile'])
        ->name('profile.index');

    Route::get('/me', [App\Http\Controllers\Me\IndexController::class, 'index'])->name('me.index');
    Route::patch('/me', [App\Http\Controllers\Me\IndexController::class, 'update'])->name('me.update');
    Route::post('/change-password', [App\Http\Controllers\Me\IndexController::class, 'changePassword'])
        ->name('me.update.password');

    Route::resource('departments', App\Http\Controllers\DepartmentController::class)
        ->only('index', 'update', 'destroy');


});


Route::prefix('employee')->name('users.')->group(function () {
    Route::get('/', App\Http\Controllers\User\IndexController::class)->name('index');
    Route::get('/create', App\Http\Controllers\User\CreateController::class)->name('create');
    Route::post('/', App\Http\Controllers\User\StoreController::class)->name('store');
    Route::get('/{user}', App\Http\Controllers\User\ShowController::class)->name('show');
    Route::patch('/{user}', App\Http\Controllers\User\UpdateController::class)->name('update');
    Route::delete('/{user}', App\Http\Controllers\User\DeleteController::class)->name('delete');

});
