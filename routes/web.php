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

    Route::get('/me', [App\Http\Controllers\MeController::class, 'index'])->name('me.index');
    Route::patch('/me', [App\Http\Controllers\MeController::class, 'update'])->name('me.update');
    Route::post('/change-password', [App\Http\Controllers\MeController::class, 'changePassword'])
        ->name('me.update.password');
    Route::get('my-issues', [App\Http\Controllers\MeController::class, 'issues'])
        ->name('me.issues');
    Route::get('my-projects', [App\Http\Controllers\MeController::class, 'projects'])
        ->name('me.projects');

    Route::resource('departments', App\Http\Controllers\DepartmentController::class)
        ->only('index', 'edit', 'update', 'destroy');

    Route::resource('positions', App\Http\Controllers\PositionController::class);

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users-position', [App\Http\Controllers\UserController::class, 'position'])
        ->name('users.position');
    Route::get('users-projects/{user}', [App\Http\Controllers\UserController::class, 'projects'])
        ->name('users.projects');
    Route::get('users-issues/{user}', [App\Http\Controllers\UserController::class, 'issues'])
        ->name('users.issues');

    Route::resource('projects', App\Http\Controllers\ProjectController::class);
    Route::patch('projects/status/{project}', [App\Http\Controllers\ProjectController::class, 'status'])
        ->name('projects.status');

    Route::resource('clients', App\Http\Controllers\ClientController::class);

    Route::resource('issues', App\Http\Controllers\IssueController::class)
        ->except('index', 'create', 'edit');
    Route::patch('issue-status/{issue}', [App\Http\Controllers\IssueController::class, 'status'])
        ->name('issues.status');

    Route::resource('comments', App\Http\Controllers\CommentController::class)
        ->only(['store', 'destroy']);
    Route::post('comments/update', [App\Http\Controllers\CommentController::class, 'updateComment']);
});
