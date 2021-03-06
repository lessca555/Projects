<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\Coba;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('collection', [CollectionController::class, 'index'])->name('collection');
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::get('edit-profile', [ProfileController::class, 'edit'])->name('profile');
Route::post('edit-profile', [ProfileController::class, 'update'])->name('profile');
Route::get('edit-password', [ProfileController::class, 'password'])->name('profile');
Route::post('edit-password', [ProfileController::class, 'cpassword'])->name('profile');
Route::get('seller', [SellerController::class, 'index'])->name('seller');
Route::get('coba', [Coba::class, 'index'])->name('seller');

