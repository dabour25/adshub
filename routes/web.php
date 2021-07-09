<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\admin\MainController as AdminMainController;
use App\Http\Controllers\admin\TransactionsController as AdminTransactionsController;

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

Route::get('/', [MainController::class,'index']);
Route::get('/login',[MainController::class,'redirectHome']);
Route::get('/register',[MainController::class,'redirectHome']);

Route::group(['prefix'=>'/auth'], function(){
    Route::get('/login', [CustomAuthController::class, 'index']);
    Route::post('/login', [CustomAuthController::class, 'customLogin']);
    Route::get('/register', [CustomAuthController::class, 'registration']);
    Route::post('/register', [CustomAuthController::class, 'customRegistration']);
    Route::get('/logout', [CustomAuthController::class, 'signOut']);
});

Route::resource('/contact',ContactController::class);
Route::get('/transactions',[TransactionsController::class,'index'])->middleware('auth');

Route::group(['prefix'=>'/admin','middleware'=>['auth','adminCheck']], function(){
    Route::get('/', [AdminMainController::class, 'index']);
    Route::resource('/transactions', AdminTransactionsController::class);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
