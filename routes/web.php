<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminDashboard;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// ADMIN AUTH
Route::get('/admin/login', [AuthController::class, 'index'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::get('/admin/logout', [AuthController::class, 'logout']);

// ADMIN PAGE
Route::group(['prefix'=> 'admin','middleware'=>['auth']], function(){
    Route::get('/', [AdminDashboard::class, 'index']);
    Route::get('/agenda', [AdminAgenda::class, 'index']);
    
    Route::post('/agenda', [AdminAgenda::class, 'postHandler']);
});
