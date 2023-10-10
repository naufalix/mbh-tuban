<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminCraft;
use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\AdminFacility;
use App\Http\Controllers\Admin\AdminGallery;
use App\Http\Controllers\Admin\AdminInstructor;
use App\Http\Controllers\Admin\AdminOrganization;
use App\Http\Controllers\Admin\AdminProgram;
use App\Http\Controllers\Admin\AdminPost;
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
    Route::get('/craft', [AdminCraft::class, 'index']);
    Route::get('/facility', [AdminFacility::class, 'index']);
    Route::get('/gallery', [AdminGallery::class, 'index']);
    Route::get('/instructor', [AdminInstructor::class, 'index']);
    Route::get('/organization', [AdminOrganization::class, 'index']);
    Route::get('/program', [AdminProgram::class, 'index']);
    Route::get('/post', [AdminPost::class, 'index']);
    
    Route::post('/craft', [AdminCraft::class, 'postHandler']);
    Route::post('/facility', [AdminFacility::class, 'postHandler']);
    Route::post('/gallery', [AdminGallery::class, 'postHandler']);
    Route::post('/instructor', [AdminInstructor::class, 'postHandler']);
    Route::post('/organization', [AdminOrganization::class, 'postHandler']);
    Route::post('/program', [AdminProgram::class, 'postHandler']);
    Route::post('/post', [AdminPost::class, 'postHandler']);
});

// API
Route::get('/api/craft/{craft:id}', [APIController::class, 'craft']);
Route::get('/api/facility/{facility:id}', [APIController::class, 'facility']);
Route::get('/api/gallery/{gallery:id}', [APIController::class, 'gallery']);
Route::get('/api/instructor/{instructor:id}', [APIController::class, 'instructor']);
Route::get('/api/organization/{organization:id}', [APIController::class, 'organization']);
Route::get('/api/program/{program:id}', [APIController::class, 'program']);
Route::get('/api/post/{post:id}', [APIController::class, 'post']);