<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => ['auth','admin']],function(){
    Route::resource('users',    UserController::class);
});

Route::group(['middleware' => ['auth']],function(){
    Route::resource('users',    UserController::class)->only('index');
    Route::get('/dashboard',    [HomeController::class,'Index'])->name('dashboard');
    Route::get('/',function(){
        return redirect()->route('dashboard');
    });
});

require __DIR__.'/auth.php';
