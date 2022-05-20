<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;

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
// Home route
Route::get('/', [PublicController::class,'homepage'])->name('homepage');
Route::post('/locale/{locale}', [PublicController::class,'locale'])->name('locale');

// Profile routes
Route::get('/profile/workWithUs', [PublicController::class,'workWithUs'])->name('profile.workWithUs');
Route::post('/profile/workWithUs/{user_info}', [PublicController::class,'sendMail'])->name('profile.sendMail');

// Ads routes
Route::get('/ad/index/{category?}', [AdController::class,'index'])->name('ad.index');
Route::get('/ad/create', [AdController::class,'create'])->name('ad.create');
Route::post('/ad/store', [AdController::class,'store'])->name('ad.store');
Route::get('/ad/show/{ad}', [AdController::class,'show'])->name('ad.show');
Route::get('/ad/sort/{ad}', [AdController::class,'sort'])->name('ad.sort');
Route::get('/ad/search', [AdController::class,'search'])->name('ad.search');

// Dropzone routes
Route::post('/ad/images/upload', [AdController::class, 'uploadImages'])->name('ad.images.upload');
Route::delete('/ad/images/remove', [AdController::class, 'removeImages'])->name('ad.images.remove');
Route::get('/ad/images', [AdController::class, 'getImages'])->name('ad.images');

// revisor routes
Route::get('revisor/index',[RevisorController::class, 'index'])->name('revisor.index');
Route::post('revisor/accept/{id}',[RevisorController::class, 'accept'])->name('revisor.accept');
Route::post('revisor/reject/{id}',[RevisorController::class, 'reject'])->name('revisor.reject');
Route::post('revisor/undo/{id}',[RevisorController::class, 'undo'])->name('revisor.undo');

// Admin routes
Route::get('admin/index',[AdminController::class, 'index'])->name('admin.index');
Route::post('admin/accept/{id}',[AdminController::class, 'accept'])->name('admin.accept');
Route::post('admin/reject/{id}',[AdminController::class, 'reject'])->name('admin.reject');
Route::post('admin/undo/{id}',[AdminController::class, 'undo'])->name('admin.undo');