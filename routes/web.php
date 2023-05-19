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

Route::get('/', function () {
    return view('login');
});

Route::get('register', function () {
    return view('register');
});

// Route::get('todo/index', function () {
//     return view('todo.index');
// });

Route::post('register', [AuthController::class, 'store']);
Route::get('login', function () {
    return view('login');
})->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

Route::get('todos/index', [TodoController::class, 'index'])->name('todos')->middleware('auth');;
Route::post('todos-status/{id}', [TodoController::class, 'todoStatus']);
Route::post('todos', [TodoController::class, 'store']);
Route::delete('todos/{id}', [TodoController::class, 'destroy']);
