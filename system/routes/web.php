<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
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
//login
Route::get('/', [AuthController::class, 'loginView']);
Route::get('login', [AuthController::class, 'loginView'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// register
Route::get('register', [AuthController::class, 'registerView']);
Route::post('register', [AuthController::class, 'register']);

//logout
Route::get('logout', [AuthController::class, 'logout']);

//todo
Route::get('todos/index', [TodoController::class, 'index'])->name('todos')->middleware('auth');;
Route::post('todos-status/{id}', [TodoController::class, 'todoStatus']);
Route::post('todos', [TodoController::class, 'store']);
Route::delete('todos/{id}', [TodoController::class, 'destroy']);
