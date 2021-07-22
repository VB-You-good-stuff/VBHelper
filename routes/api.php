<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('member',MemberController::class);
Route::resource('guestbook',GuestbookController::class);
Route::resource('article',ArticleController::class);

/*
Route::get('/member',[MemberController::class,'index']);
Route::post('/member',[MemberController::class,'store']);
*/