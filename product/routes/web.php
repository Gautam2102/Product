<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

// 

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/addproduct', [HomeController::class, 'addproduct'])->name('addproduct');
Route::post('/insertproduct', [HomeController::class, 'insertproduct'])->name('insertproduct');
Route::get('/showproduct', [HomeController::class, 'showproduct'])->name('showproduct');
Route::get('/editproduct/{id}',[HomeController::class,'editproduct'])->name('editproduct');
Route::post('/updateproduct',[HomeController::class,'updateproduct'])->name('updateproduct');
Route::get('/deleteproduct/{id}',[HomeController::class,'deleteproduct'])->name('deleteproduct');
Route::get('/imgvid/{id}',[HomeController::class,'imgvid'])->name('imgvid');
Route::post('/importForm',[HomeController::class,'importForm'])->name('importForm');
Route::get('/download',[HomeController::class,'export'])->name('download');
