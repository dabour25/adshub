<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ContactController;

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
Route::group(['prefix'=>'/auth'], function(){
    Route::get('/login', [CustomAuthController::class, 'index']);
    Route::post('/login', [CustomAuthController::class, 'customLogin']);
    Route::get('/register', [CustomAuthController::class, 'registration']);
    Route::post('/register', [CustomAuthController::class, 'customRegistration']);
    Route::get('/logout', [CustomAuthController::class, 'signOut']);
});

Route::resource('/contact',ContactController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
