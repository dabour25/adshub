<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\admin\MainController as AdminMainController;
use App\Http\Controllers\admin\TransactionsController as AdminTransactionsController;
use App\Http\Controllers\admin\RequestsController as AdminRequestsController;
use App\Http\Controllers\admin\UsersController as AdminUsersController;
use App\Http\Controllers\admin\AdsController as AdminAdsController;

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
Route::get('lang/{language}',[MainController::class,'lang']);
Route::get('/login',[MainController::class,'redirectHome']);
Route::get('/register',[MainController::class,'redirectHome']);

Route::group(['prefix'=>'/auth'], function(){
    Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
    Route::post('/login', [CustomAuthController::class, 'customLogin']);
    Route::get('/register', [CustomAuthController::class, 'registration']);
    Route::post('/register', [CustomAuthController::class, 'customRegistration']);
    Route::get('/logout', [CustomAuthController::class, 'signOut']);
});

Route::resource('/contact',ContactController::class);
Route::get('/terms',[MainController::class,'terms']);
Route::get('/transactions',[TransactionsController::class,'index'])->middleware('auth');
Route::resource('/cash-request',RequestsController::class)->middleware('auth');
Route::get('/profile',[CustomAuthController::class,'profile'])->middleware('auth');
Route::get('/profile/edit',[CustomAuthController::class,'profileEdit'])->middleware('auth');
Route::post('/profile/edit',[CustomAuthController::class,'profileUpdate'])->middleware('auth');
Route::post('/change-password',[CustomAuthController::class,'changePassword'])->middleware('auth');
Route::get('/create-ad',[AdsController::class,'index'])->middleware('auth');
Route::post('/create-ad',[AdsController::class,'store'])->middleware('auth');
Route::get('/transfer',[TransactionsController::class,'transferShow'])->middleware('auth');
Route::post('/transfer',[TransactionsController::class,'transfer'])->middleware('auth');
Route::get('/view-ads',[AdsController::class,'showAds'])->middleware('auth');
Route::post('/view-ads',[AdsController::class,'earnAd'])->middleware('auth');
Route::get('/user-ads',[AdsController::class,'userAds'])->middleware('auth');
Route::get('/user-ads/{slug}',[AdsController::class,'userAd'])->middleware('auth');

Route::group(['prefix'=>'/admin','middleware'=>['auth','adminCheck']], function(){
    Route::get('/', [AdminMainController::class, 'index']);
    Route::get('/messages', [AdminMainController::class, 'messages']);
    Route::resource('/transactions', AdminTransactionsController::class);
    Route::resource('/requests', AdminRequestsController::class);
    Route::get('/cancel-request/{request_id}', [AdminRequestsController::class,'cancelRequest']);
    Route::get('/old-requests', [AdminRequestsController::class,'oldRequests']);
    Route::resource('/users', AdminUsersController::class);
    Route::resource('/ads', AdminAdsController::class);
    Route::get('/old-ads', [AdminAdsController::class,'oldAds']);
    Route::get('/cancel-ad/{ad_id}', [AdminAdsController::class,'rejectAd']);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
